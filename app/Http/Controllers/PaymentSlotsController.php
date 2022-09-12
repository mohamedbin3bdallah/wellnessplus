<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PayPal\Api\Payout;
use App\MyFatoora\PaymentMyfatoorahApiV2;
use App\User;
use App\Currency;
use App\Cart;
use PayPal\Api\PayoutSenderBatchHeader;
use PayPal\Api\PayoutItem;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use App\CompletedPayout;
use App\PendingPayout;
use Auth;
use Session;


class PaymentSlotsController extends Controller
{
	  private $_api_Key = 'rLtt6JWvbUHDDhsZnfpAhpYk4dxYDQkbcPTyGaKp2TYqQgG7FGZ5Th_WD53Oq8Ebz6A53njUoo1w3pjU1D4vs_ZMqFiz_j0urb_BH9Oq9VZoKFoJEDAbRZepGcQanImyYrry7Kt6MnMdgfG5jn4HngWoRdKduNNyP4kzcp3mRv7x00ahkm9LAK7ZRieg7k1PDAnBIOG3EyVSJ5kK4WLMvYr7sCwHbHcu4A5WwelxYK0GMJy37bNAarSJDFQsJ2ZvJjvMDmfWwDVFEVe_5tOomfVNt6bOg9mexbGjMrnHBnKnZR1vQbBtQieDlQepzTZMuQrSuKn-t5XZM7V6fCW7oP-uXGX-sMOajeX65JOf6XVpk29DP6ro8WTAflCDANC193yof8-f5_EYY-3hXhJj7RBXmizDpneEQDSaSz5sFk0sV5qPcARJ9zGG73vuGFyenjPPmtDtXtpx35A-BVcOSBYVIWe9kndG3nclfefjKEuZ3m4jL9Gg1h2JBvmXSMYiZtp9MR5I6pvbvylU_PP5xJFSjVTIz7IQSjcVGO41npnwIxRXNRxFOdIUHn0tjQ-7LwvEcTXyPsHXcMD8WtgBh-wxR8aKX7WPSsT1O8d8reb2aR7K3rkV3K82K_0OgawImEpwSvp9MNKynEAJQS6ZHe_J_l77652xwPNxMRTMASk1ZsJL';
	  private $_is_Test_Mode = true;
	  
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */	
	public function makePayment(Request $request)
    {

        $apiKey = $this->_api_Key;
		$isTestMode = $this->_is_Test_Mode;
		
		$txRef = base64_decode($request->tx_ref);
        $txRef = explode( '-', $txRef);
		$cart_ids = explode( '_', $txRef[0]);
		
		$cartSum = Cart::selectRaw('sum(offer_price) as offer_price, sum(disamount) as disamount')->whereIn('id', $cart_ids)->get()->toArray();

        if(array_filter($cartSum)){
			$transaction_fees = number_format(((($cartSum[0]['offer_price'] - $cartSum[0]['disamount']) * 3.8 ) / 100), 2, '.', '');
			$bank_fees = number_format(((($cartSum[0]['offer_price'] - $cartSum[0]['disamount']) * 1.4 ) / 100), 2, '.', '');
			$amount = $cartSum[0]['offer_price'] - $cartSum[0]['disamount'] + $transaction_fees - $bank_fees;
			
			if($amount > 0){			
				$mfPayment = new PaymentMyfatoorahApiV2($apiKey, $isTestMode);

				$postFields = [
					'NotificationOption' => 'Lnk',
					'InvoiceValue'       => $amount,
					'CustomerName'       => $request->name,
					'CustomerMobile'       => $request->mobile,
					'CustomerEmail'       => $request->email,
					//'CallBackUrl'       => 'https://www.arabie.live/payment/'.$request->type.'?tx_ref='.$request->tx_ref.'&status=successful&transaction_id='.rand(),
					'CallBackUrl'       => url('/payment-slots/success/?type='.$request->type.'&tx_ref='.$request->tx_ref),
					'ErrorUrl'       => url('/payment-slots/fail'.$request->page),
					'Language'       => 'ar',
					'CustomerReference'       => $request->ref,
					'DisplayCurrencyIso'       => 'USD',
					'MobileCountryCode'       => '',
				];
    
				$data = $mfPayment->getInvoiceURL($postFields, 'myfatoorah', $request->tx_ref);
				return redirect($data['invoiceURL']);
				/*header('Location: ' . $data['invoiceURL'], true, 303);
				die();*/
			}
        }
		else
		{
			return redirect($request->page);
        }
    }
	
	/*
	** Payment Refund
	*/
	public static function refund($paymentId, $amount){
        $apiKey = $this->_api_Key;
		$isTestMode = $this->_is_Test_Mode;

        $mfPayment = new PaymentMyfatoorahApiV2($apiKey, $isTestMode);

        $data = $mfPayment->refund($paymentId, $amount, 'USD', '', '');
		return $data;
    }
	
	/*
	** Payment Success
	*/
	public function success(){
        $paymentId= $_GET['paymentId'];

        $apiKey = $this->_api_Key;
		$isTestMode = $this->_is_Test_Mode;

        $mfPayment = new PaymentMyfatoorahApiV2($apiKey, $isTestMode);

        $data = $mfPayment->getPaymentStatus($_GET['paymentId'], 'paymentId');

        if($data->InvoiceStatus != 'Paid')
		{
			Session::flash('error','Payment Fail');
			return redirect('/');
        }
		else
		{
			return redirect('/payment-slots/'.$_GET['type'].'?tx_ref='.$_GET['tx_ref'].'&status=successful&transaction_id='.$data->InvoiceTransactions[0]->TransactionId);
		}
    }
	
	/*
	** Payment Fail
	*/
	public function fail($page,$id)
    {
		Session::flash('error',__('backend.payment_failed'));
        return redirect($page.'/'.$id);
	}
	public function failDashboard($page)
    {
		Session::flash('error',__('backend.payment_failed'));
        return redirect($page);
	}


}
