<?php

namespace App\Http\Controllers\Payments;

use App\Http\Controllers\Controller;
use App\Models\LogoPrice;
use App\Models\Setting;
use App\Models\Payment;
use App\Notifications\SendLogo;
use App\Services\ImageServices;
use Illuminate\Http\Request;
use App\Models\BillingDetail;

class StripeController extends Controller
{
    /**
     * @param Request $request
     * @param LogoPrice $price
     * @return \Illuminate\Http\JsonResponse
     */
    public function pay(Request $request, LogoPrice $price)
    {
        $request->validate([
            'card_number' => 'required|min:16',
            'cardholder_name' => 'required',
            'cvv' => 'required',
            'expiration_date' => 'required',
        ]);

        if (isset($request->billing_details)) {
            foreach ($request->billing_details as $field_name => $detail) {
                BillingDetail::updateOrCreate(
                    [
                        'user_id' => auth()->user()->id
                    ],
                    [
                        'user_id' => auth()->user()->id,
                        $field_name => $detail
                    ]
                );
            }
        }

        \Stripe\Stripe::setApiKey(Setting::findByName('stripe_secret_key')->data ?? null);
        $user = auth()->user();

        $stripe = new \Stripe\StripeClient(Setting::findByName('stripe_secret_key')->data ?? null);

        try {
            $date = explode('/', $request->expiration_date);
            $name = explode(' ', $request->cardholder_name);

            $token = $stripe->tokens->create([
                'card' => [
                    'number' => $request->card_number,
                    'exp_month' => $date[0],
                    'exp_year' => $date[1],
                    'cvc' => $request->cvv,
                ]
            ]);

            $charge = \Stripe\Charge::create([
                'amount' => (int)$price->price * 100,
                'currency' => strtolower($price->currency),
                'source' => $token->id,
                'description' => 'Payment for logo.',
            ]);

            if ($charge->paid) {
            	//TODO fix

                $payment = Payment::create([
                    'amount' => (int)$price->price * 100,
                    'currency' => strtolower($price->currency),
                    'type' => 'stripe',
                    'paymentId' => $charge->id,
                    'user_id' => $user->id,
                    'logo_price_id' => $price->id
                ]);

                $message_data = [
                    'amount' => $price->price,
                    'transcation_date' => $payment->created_at->format('Y-m-d h:i:s'),
                    'package_name' => $price->title,
                    'price' => $price->price,
                    'symbol' => $price->symbol,
                    'includes' => $price->advantages
                ];

                $user->notify(new SendLogo(ImageServices::saveImage($price), $message_data));

                return response()->json([
                    'success' => true,
                    'paymentId' => $payment->id
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Payment error. Please try again.'
                ]);
            }

        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage()
            ]);
        }
    }
}
