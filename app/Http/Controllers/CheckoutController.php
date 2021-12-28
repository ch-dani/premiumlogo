<?php

namespace App\Http\Controllers;

use App\Models\LogoPrice;
use App\Models\Payment;
use App\Services\ImageServices;
use App\Notifications\SendLogo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Image;
use function Couchbase\defaultDecoder;

class CheckoutController extends Controller
{
    /**
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
     */
    public function index()
    {
        $logo = \App\Helpers\Logo::getUserLastLogo();

        if (!auth()->check()) {
            return redirect(route('login'));
        }

        return view('site.checkout.checkout3', compact('logo'));
    }

    /**
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
     */
    public function example()
    {
        $logo = \App\Helpers\Logo::getUserLastLogo();

        if (!$logo) {
            return redirect(route('logo'));
        }

        return view('site.checkout.example', compact('logo'));
    }

    /**
     * @param LogoPrice $logoPrice
     * @param Request $request
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
     */
    public function pay(LogoPrice $logoPrice, Request $request)
    {
        if (isset($request->paymentId) && isset($request->PayerID)) {
            //TODO fix

            $payment = Payment::create([
                'amount' => (int)$logoPrice->price * 100,
                'currency' => strtolower($logoPrice->currency),
                'type' => 'paypal',
                'paymentId' => $request->paymentId,
                'user_id' => auth()->user()->id,
                'logo_price_id' => $logoPrice->id
            ]);

            $message_data = [
                'amount' => $logoPrice->price,
                'transcation_date' => $payment->created_at->format('Y-m-d h:i:s'),
                'package_name' => $logoPrice->title,
                'price' => $logoPrice->price,
                'symbol' => $logoPrice->symbol,
                'includes' => $logoPrice->advantages
            ];

            auth()->user()->notify(new SendLogo(ImageServices::saveImage($logoPrice), $message_data));
            return redirect(route('success', $payment->id));
        }

        return view('site.checkout.pay', compact('logoPrice'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkout(Request $request)
    {
    	try{
		    $logoPrice = LogoPrice::find($request->plan);
		    if ($logoPrice->price != 'free') {
		        return response()->json([
		            'redirectUrl' => route('pay', $logoPrice->id)
		        ]);
		    }
		    
		    auth()->user()->notify(new SendLogo(ImageServices::saveImage($logoPrice)));
		    return response()->json([
		        'redirectUrl' => route('success')
		    ]);

    	}catch(\Swift_TransportException $e){
    		return ["success"=>false, "message"=>$e->getMessage()];
    	}
    	
    }

    /**
     * @param Payment $payment
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
     */
    public function success(Payment $payment)
    {
        if (auth()->user()->id != $payment['user_id']) {
            abort(404);
        }

        return view('site.checkout.success', compact('payment'));
    }
}
