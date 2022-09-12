<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PayPal\Api\Payout;
use App\MyFatoora\PaymentMyfatoorahApiV2;
use App\User;
use App\Currency;
use PayPal\Api\PayoutSenderBatchHeader;
use PayPal\Api\PayoutItem;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use App\CompletedPayout;
use App\PendingPayout;
use Auth;
use Session;


class PaymentController extends Controller
{
	  private $_api_context;
	  
	  private $_api_Key = 'rLtt6JWvbUHDDhsZnfpAhpYk4dxYDQkbcPTyGaKp2TYqQgG7FGZ5Th_WD53Oq8Ebz6A53njUoo1w3pjU1D4vs_ZMqFiz_j0urb_BH9Oq9VZoKFoJEDAbRZepGcQanImyYrry7Kt6MnMdgfG5jn4HngWoRdKduNNyP4kzcp3mRv7x00ahkm9LAK7ZRieg7k1PDAnBIOG3EyVSJ5kK4WLMvYr7sCwHbHcu4A5WwelxYK0GMJy37bNAarSJDFQsJ2ZvJjvMDmfWwDVFEVe_5tOomfVNt6bOg9mexbGjMrnHBnKnZR1vQbBtQieDlQepzTZMuQrSuKn-t5XZM7V6fCW7oP-uXGX-sMOajeX65JOf6XVpk29DP6ro8WTAflCDANC193yof8-f5_EYY-3hXhJj7RBXmizDpneEQDSaSz5sFk0sV5qPcARJ9zGG73vuGFyenjPPmtDtXtpx35A-BVcOSBYVIWe9kndG3nclfefjKEuZ3m4jL9Gg1h2JBvmXSMYiZtp9MR5I6pvbvylU_PP5xJFSjVTIz7IQSjcVGO41npnwIxRXNRxFOdIUHn0tjQ-7LwvEcTXyPsHXcMD8WtgBh-wxR8aKX7WPSsT1O8d8reb2aR7K3rkV3K82K_0OgawImEpwSvp9MNKynEAJQS6ZHe_J_l77652xwPNxMRTMASk1ZsJL';
	  private $_is_Test_Mode = true;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
      /** PayPal api context **/
      $paypal_conf = \Config::get('paypal');
      $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
      $this
          ->_api_context
          ->setConfig($paypal_conf['settings']);
    }

    public function paypal(Request $request, $id)
    {

     $all_checked =  $request->checked;
      $pay_total =  $request->total;

      $user = User::where('id', $id)->first();


        if($user->prefer_pay_method == "paypal")
        {
          	$amount = $request->total;

          	$user = User::where('id', $id)->first();

          	$sendemail = $user->paypal_email;
              $Currency = Currency::first();
              $defCurrency = $Currency->currency;
              $uniqid = str_random(10);
              $payouts = new Payout();
              // $inv_cus = Invoice::first();
              $senderBatchHeader = new PayoutSenderBatchHeader();
              $senderBatchHeader->setSenderBatchId(uniqid())
                  ->setEmailSubject("You have a Payout!");
              $senderItem = new PayoutItem();
              $senderItem->setRecipientType('Email')
                  ->setNote(__('backend.thanks_for_using_our_portal_for_selling_your_product'))
                  ->setReceiver($sendemail)
                  ->setSenderItemId($uniqid)
                  ->setAmount(new \PayPal\Api\Currency('{
                                      "value":'.$amount.',
                                      "currency":"'.$defCurrency.'"
                                  }'));
              $payouts->setSenderBatchHeader($senderBatchHeader)
                  ->addItem($senderItem);
              $request = clone $payouts;

              // return $request;

              try
              {
                  $output = $payouts->create(array('sync_mode' => 'false'), $this->_api_context);
                  $bid = $output->batch_header->payout_batch_id;
                  $response =  Payout::get($bid,$this->_api_context);


                  $currency = Currency::first();


                  $orders = array();

                  foreach ($all_checked as $checked) {

                      $payout = PendingPayout::findOrFail($checked);

                      $orders[] = $payout->order->id;

                  }

                  $created_order = CompletedPayout::create([
                        'user_id' => $id,
                        'payer_id' => Auth::User()->id,
                        'pay_total' => $pay_total,
                        'order_id' =>  $orders,
                        'payment_method' => 'banktransfer',
                        'currency' => $currency->currency,
                        'currency_icon' => $currency->icon,
                        'pay_status' => 1,
                        'created_at'  => \Carbon\Carbon::now()->toDateTimeString(),
                        'updated_at'  => \Carbon\Carbon::now()->toDateTimeString(),
                        ]
                    );

                    if($created_order){

                      foreach($all_checked as $checked) {

                          $payout = PendingPayout::findOrFail($checked);


                          // PendingPayout::where('id', $checked)->delete();

                          PendingPayout::where('id', $checked)
                          ->update(['status' => '1']);

                      }

                    }

                   session()->flash('success',__('backend.payment_success'));

                    return redirect('admins/instructor');


        			}
              catch(\Exception $e){

                $errorcode = $e->getCode();

                if($errorcode == 422){

                    Session::flash('delete',__('backend.insufficient_funds_check_your_paypal_account'));
                    return view('admins/instructor');
                 }

                 if($errorcode == 400){

                    Session::flash('delete',__('backend.currency_not_supported_in_paypal'));
                    return view('admins/instructor');
                 }

                session()->flash('delete',__('backend.payment_failed'));
                return redirect('admins/instructor');
          		}




        }


      }


      public function banktransfer(Request $request, $id)
      {

        $user = User::where('id', $id)->first();

        if($user->prefer_pay_method == "banktransfer")
        {

          $currency = Currency::first();



          $orders = array();

          foreach ($request->checked as $checked) {

              $payout = PendingPayout::findOrFail($checked);

              $orders[] = $payout->order->id;

          }

          $created_order = CompletedPayout::create([
                'user_id' => $id,
                'payer_id' => Auth::User()->id,
                'pay_total' => $request->total,
                'order_id' =>  $orders,
                'payment_method' => 'banktransfer',
                'currency' => $currency->currency,
                'currency_icon' => $currency->icon,
                'pay_status' => 1,
                'created_at'  => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at'  => \Carbon\Carbon::now()->toDateTimeString(),
                ]
            );

            if($created_order){

              foreach($request->checked as $checked) {

                  $payout = PendingPayout::findOrFail($checked);


                  // PendingPayout::where('id', $checked)->delete();
                  PendingPayout::where('id', $checked)
                          ->update(['status' => '1']);

              }

            }

           session()->flash('success',__('backend.payment_success'));

            return redirect('admins/instructor');


        }

      }

      public function paytm(Request $request, $id)
      {

        $user = User::where('id', $id)->first();

        if($user->prefer_pay_method == "paytm")
        {

          $currency = Currency::first();

          $orders = array();

          foreach ($request->checked as $checked) {

              $payout = PendingPayout::findOrFail($checked);

              $orders[] = $payout->order->id;

          }


          $created_order = CompletedPayout::create([
                'user_id' => $id,
                'payer_id' => Auth::User()->id,
                'pay_total' => $request->total,
                'order_id' =>  $orders,
                'payment_method' => 'paytm',
                'currency' => $currency->currency,
                'currency_icon' => $currency->icon,
                'pay_status' => 1,
                'created_at'  => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at'  => \Carbon\Carbon::now()->toDateTimeString(),
                ]
            );

            if($created_order){

              foreach($request->checked as $checked) {

                  $payout = PendingPayout::findOrFail($checked);


                  // PendingPayout::where('id', $checked)->delete();
                  PendingPayout::where('id', $checked)
                          ->update(['status' => '1']);

              }

            }

           session()->flash('success',__('backend.payment_success'));

            return redirect('admins/instructor');


        }

      }
	  
	public function makePayment(Request $request)
    {

        $apiKey = $this->_api_Key;
		$isTestMode = $this->_is_Test_Mode;
		
		$txRef = base64_decode($request->tx_ref);

        if($request->amount >0){
            $mfPayment = new PaymentMyfatoorahApiV2($apiKey, $isTestMode);

            $postFields = [
                'NotificationOption' => 'Lnk',
                'InvoiceValue'       => $request->amount,
                'CustomerName'       => $request->name,
                'CustomerMobile'       => $request->mobile,
                'CustomerEmail'       => $request->email,
                //'CallBackUrl'       => 'https://www.arabie.live/payment/'.$request->type.'?tx_ref='.$request->tx_ref.'&status=successful&transaction_id='.rand(),
				'CallBackUrl'       => url('/payment/success/?type='.$request->type.'&tx_ref='.$request->tx_ref),
                'ErrorUrl'       => url('/payment/fail'.$request->page),
                'Language'       => 'ar',
                'CustomerReference'       => $request->tx_ref,
                'DisplayCurrencyIso'       => 'USD',
                'MobileCountryCode'       => '',
            ];
    
            $data = $mfPayment->getInvoiceURL($postFields, 'myfatoorah', $request->tx_ref);
			return redirect($data['invoiceURL']);
			/*header('Location: ' . $data['invoiceURL'], true, 303);
			die();*/
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
			return redirect('/payment/'.$_GET['type'].'?tx_ref='.$_GET['tx_ref'].'&status=successful&transaction_id='.$data->InvoiceTransactions[0]->TransactionId);
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
