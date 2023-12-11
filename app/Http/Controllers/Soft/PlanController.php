<?php

namespace App\Http\Controllers\Soft;
use App\Http\Controllers\Api\Apps\Manager;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Plan;
use App\Models\WebSetting;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Session;
use App\Logic\Notification;
use Illuminate\Support\Facades\Auth;
use DB;
class PlanController extends Controller
{
    function __construct()
    {

    }
    public function plan($id, $title)
	{
	$plan = Plan::where("id",$id)->first();
        return view("App.PricingDetail", compact('plan'));
    }
	
	 public function processTransaction(Request $request,$id,$amount)
    {
		
		Session::put('plan_id', $id);
        $provider = new PayPalClient;
		
		$paypalClientId = WebSetting::where("key",'paypalClientId')->first()->value;
		$paypalClientSecret = WebSetting::where("key",'paypalClientSecret')->first()->value;
		$paypalappId = WebSetting::where("key",'paypalappId')->first()->value;
		$paypalmode = WebSetting::where("key",'paypalmode')->first()->value;
    
		$credentials = [
			'mode'    => $paypalmode, // Can only be 'sandbox' Or 'live'. If empty or invalid, 'live' will be used.
			'sandbox' => [
				'client_id'         => $paypalClientId,
				'client_secret'     => $paypalClientSecret,
				'app_id'            => $paypalappId,
			],
			'live' => [
				'client_id'         => $paypalClientId,
				'client_secret'     => $paypalClientSecret,
				'app_id'            => $paypalappId,
			],

			'payment_action' => env('PAYPAL_PAYMENT_ACTION', 'Sale'), // Can only be 'Sale', 'Authorization' or 'Order'
			'currency'       => env('PAYPAL_CURRENCY', 'USD'),
			'notify_url'     => env('PAYPAL_NOTIFY_URL', ''), // Change this accordingly for your application.
			'locale'         => env('PAYPAL_LOCALE', 'en_US'), // force gateway language  i.e. it_IT, es_ES, en_US ... (for express checkout only)
			'validate_ssl'   => env('PAYPAL_VALIDATE_SSL', true),
		];

        $provider->setApiCredentials($credentials);
        $paypalToken = $provider->getAccessToken();
        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
            
                "return_url" => route('plans.successTransaction'),
                "cancel_url" => route('plans.cancelTransaction'),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $amount
                    ]
                ]
            ]
        ]);
        if (isset($response['id']) && $response['id'] != null) {
            // redirect to approve href
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return redirect()->away($links['href']);
                }
            }
            return redirect()
                ->route('Apps.pricings')
                ->with('error', 'Something went wrong.');
        } else {
            return redirect()
                ->route('Apps.pricings')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }
	
	
	    public function successTransaction(Request $request)
    {
        $provider = new PayPalClient;
		$paypalClientId = WebSetting::where("key",'paypalClientId')->first()->value;
		$paypalClientSecret = WebSetting::where("key",'paypalClientSecret')->first()->value;
		$paypalappId = WebSetting::where("key",'paypalappId')->first()->value;
		$paypalmode = WebSetting::where("key",'paypalmode')->first()->value;
    
		$credentials = [
			'mode'    => $paypalmode, // Can only be 'sandbox' Or 'live'. If empty or invalid, 'live' will be used.
			'sandbox' => [
				'client_id'         => $paypalClientId,
				'client_secret'     => $paypalClientSecret,
				'app_id'            => $paypalappId,
			],
			'live' => [
				'client_id'         => $paypalClientId,
				'client_secret'     => $paypalClientSecret,
				'app_id'            => $paypalappId,
			],

			'payment_action' => env('PAYPAL_PAYMENT_ACTION', 'Sale'), // Can only be 'Sale', 'Authorization' or 'Order'
			'currency'       => env('PAYPAL_CURRENCY', 'USD'),
			'notify_url'     => env('PAYPAL_NOTIFY_URL', ''), // Change this accordingly for your application.
			'locale'         => env('PAYPAL_LOCALE', 'en_US'), // force gateway language  i.e. it_IT, es_ES, en_US ... (for express checkout only)
			'validate_ssl'   => env('PAYPAL_VALIDATE_SSL', true),
		];

        $provider->setApiCredentials($credentials);
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);
        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
			$plan_id = Session::get('plan_id');
			$user_id = Auth::id();
			 $user = User::find($user_id);
            $user->plan_id = $plan_id;
             $user->save();
			 $plan = Plan::where("id",$plan_id)->first();
			 $manager = new Manager;
			 $manager->updateZaps($user_id,$plan->maxConnections,$plan->taskPerMonth);
			 
			 DB::table('invoices')->insert([
				'user_id' => $user_id,
				'plan_id' => $plan_id,
				'amount' => $plan->price,
				'status' => "Success",
				'created_at' => date('Y-m-d H:i:s'),
				'response' => json_encode($response),
				'updated_at' => date('Y-m-d H:i:s')
			]);
			  Notification::setNotification('Success', "Transaction complete.", 'success', 'bottom');
            
            return redirect()
                ->route('Apps.pricings');
        } else {
			Notification::setNotification('Notice', $response['message'] ?? 'Something went wrong.', 'warning', 'bottom');
            
            return redirect()
                ->route('Apps.pricings');
        }
    }
    /**
     * cancel transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function cancelTransaction(Request $request)
    {
		Notification::setNotification('Notice', $response['message'] ?? 'You have canceled the transaction.', 'warning', 'bottom');
            
        return redirect()
            ->route('Apps.pricings');
    }
   
}
