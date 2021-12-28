<?php

namespace App\Http\Controllers\Payments;

use App\Http\Controllers\Controller;
use App\Models\LogoPrice;
use App\Models\Setting;
use Illuminate\Http\Request;

class PayPalController extends Controller
{

    /**
     * @param LogoPrice $price
     * @param Request $request
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View|mixed
     */
    public function redirect(LogoPrice $price, Request $request)
    {
        $apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
             Setting::findByName('paypal_client_id')->data ?? null,
             Setting::findByName('paypal_secret_key')->data ?? null
            )
        );

        if ((Setting::findByName('paypal_mode')->data ?? null) == 'live') {
            $apiContext->setConfig(["mode" => "live"]);
        }

        $payer = new \PayPal\Api\Payer();
        $payer->setPaymentMethod("paypal");

        $item1 = new \PayPal\Api\Item();
        $item1->setName($price->title)
            ->setCurrency(strtoupper($price->currency))
            ->setQuantity(1)
            ->setPrice($price->price);

        $itemList = new \PayPal\Api\ItemList();
        $itemList->setItems(array($item1));

        $details = new \PayPal\Api\Details();
        $details->setShipping(0)
            ->setTax(0)
            ->setSubtotal($price->price);

        $amount = new \PayPal\Api\Amount();
        $amount->setCurrency("USD")
            ->setTotal($price->price)
            ->setDetails($details);

        $transaction = new \PayPal\Api\Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setCustom(auth()->user()->id)
            ->setDescription('Subscription plan.')
            ->setInvoiceNumber(uniqid());

        $redirectUrls = new \PayPal\Api\RedirectUrls();
        $redirectUrls->setReturnUrl(route('pay', $price->id))->setCancelUrl(route('save-logo'));

        $payment = new \PayPal\Api\Payment();
        $payment->setIntent("sale")
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions(array($transaction));

        try {
            $payment->create($apiContext);

            return redirect()->to($payment->getApprovalLink());
        } catch (\Exception $exception) {
            return  view('pay', $price->id);
        }
    }
}
