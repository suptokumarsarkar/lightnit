<?php

namespace App\Http\Controllers\Apps;

use App\Apps\AppInfo;
use App\Http\Controllers\Controller;
use App\Logic\Helpers;
use App\Logic\Notification;
use App\Models\AppsData;
use App\Models\Zap;
use App\Models\Plan;
use App\Models\ZapRecord;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use Carbon\Carbon;
class AppPageController extends Controller
{
    public function index()
    {
        return view("App.Apps");
    }
	
	public function transfers (){
		
		return view("App.transfers");
	}
	
	public function newtransfers (){
		 
		return view("App.newtransfers");
	}
	
	public function newtransfers_slug ($slug){
		 
		return view("App.newtransfers_slug");
	}
	
	 public function pricingPage()
    {
        $plans = Plan::orderBy("price")->get();
        return view("App.Pricing", compact('plans'));
    }
	
	 public function nitshistory()
    {
		
        $zaps = Zap::where("userId",Auth::id())->get();
        $zap_records = ZapRecord::where("userId",Auth::id())->whereBetween('created_at', [date('Y-m-d'), date('Y-m-d')])->get();
		$date1 = $date2 = date('Y-m-d');
	 	$startDate = Carbon::createFromDate($date1);
		$endDate = Carbon::createFromDate($date2);
		$user_id =  Auth::id();
			$date_array = array();
			$date_data_array = array();
		for ($date = $startDate->copy(); $date->lte($endDate); $date->addDay()) {
			$date1 =  date('Y-m-d',strtotime($date->toDateString()));
			$date_array[] = date('M, d,Y',strtotime($date->toDateString()));
			
			$zap_record_count =DB::select("select count(id) as total from `zap_records` where Date(created_at) = '".$date1."' and  `userId` = $user_id");
   			$date_data_array[] = ($zap_record_count[0]->total);
		}
		return view("App.Nitshistory", compact('zaps','zap_records','date_array','date_data_array'));
    }
	
	public function getnits(Request $request){
		
		
		$date = $request->daterange;
		$zaps = $request->zaps;
		$apps = $request->apps;
		
		$date = (explode('-',$date));
		$date1 = date('Y-m-d',strtotime($date['0']));
		$date2 = date('Y-m-d',strtotime($date['1']));
		
		//$AppIds = '%\"AppId\":\"'.$apps.'\"%';
		//$zaps =DB::select("select count(id) as total from `zaps` where `zapData` LIKE '$AppIds' and  `userId` = $user_id");
      
		 		
		$zaps = Zap::where("userId",Auth::id())->whereBetween('created_at', [$date1, $date2])->get();
        $zap_records = ZapRecord::where("userId",Auth::id())->whereBetween('created_at', [$date1, $date2])->count();
		
		$startDate = Carbon::createFromDate($date1);
		$endDate = Carbon::createFromDate($date2);
		$user_id =  Auth::id();
			$date_array = array();
			$date_data_array = array();
		for ($date = $startDate->copy(); $date->lte($endDate); $date->addDay()) {
			$date1 =  date('Y-m-d',strtotime($date->toDateString()));
			$date_array[] = date('M, d,Y',strtotime($date->toDateString()));
			
			$zap_record_count =DB::select("select count(id) as total from `zap_records` where Date(created_at) = '".$date1."' and  `userId` = $user_id");
   		//$zap_records = ZapRecord::where("userId",Auth::id())->where('Date(created_at)',$date1)->get();
			$date_data_array[] = ($zap_record_count[0]->total);
		}

		return view("App.Nitshistory_ajax", compact('zaps','zap_records','date_array','date_data_array'));
    
	}
	
	
	public function getnits_ajax(Request $request){
		
		
		$date = $request->daterange;
		$zaps = $request->zaps;
		$apps = $request->apps;
		
		$date = (explode('-',$date));
		$date1 = date('Y-m-d',strtotime($date['0']));
		$date2 = date('Y-m-d',strtotime($date['1']));
		
	  
		 		
		$zaps = Zap::where("userId",Auth::id())->whereBetween('created_at', [$date1, $date2])->get();
        $zap_records = ZapRecord::where("userId",Auth::id())->whereBetween('created_at', [$date1, $date2])->get();
		
		
	 
		return view("App.Nitshistory_list_ajax", compact('zaps','zap_records'));
    
	}
	
	 public function nits_list_history()
    {
		
        $zaps = Zap::where("userId",Auth::id())->get();
		
	 
		return view("App.Nits_list_history", compact('zaps'));
    }
	public function mynits()
    {
		$user_id =Auth::id();
		
		$accounts =DB::select("select count(type) as total,type from `accounts` where `accountId` = $user_id group by `type`");
        // $accounts = Account::select('accounts.*', DB::raw('count(*) as total'))->where("accountId", Auth::id())->groupBy("type")->get();
		
		if(!empty($accounts)){
			foreach ($accounts as $key => $account)
			{
				$app_data = AppsData::where('AppId', $account->type)->first();
				$logo = $app_data->getLogo();
				$type  = $account->type;
				$accounts[$key]->type = $type;
				$accounts[$key]->logo = $logo;
				$accounts[$key]->app_name = $app_data->AppName;
				
				$AppIds = '%\"AppId\":\"'.$type.'\"%';
				$zaps =DB::select("select count(id) as total from `zaps` where `zapData` LIKE '$AppIds' and  `userId` = $user_id");
      
				//$zaps = Zap::whereLike('zapData', $AppIds,true)->where("userId",Auth::id())->get();
				
				$accounts[$key]->zaps = !empty($zaps)?$zaps[0]->total:0;
			}
		}
		
		
		return view("App.mynits", compact('accounts'));
    }
	
		public function connection_apps($slug)
    {
		$user_id =Auth::id();
		
		$accounts = DB::select("select * from `accounts` where `accountId` = $user_id and type='$slug'");

		if(!empty($accounts)){
			foreach ($accounts as $key => $account)
			{
				$app_data = AppsData::where('AppId', $account->type)->first();
				$logo = $app_data->getLogo();
				$type  = $account->type;
				$accounts[$key]->logo = $logo;
				$accounts[$key]->app_name = $app_data->AppName;
				
				$AppIds = '%\"AppId\":\"'.$type.'\"%';
				$zaps_count =DB::select("select count(id) as total from `zaps` where `zapData` LIKE '$AppIds' and  `userId` = $user_id");
      
				//$zaps = Zap::whereLike('zapData', $AppIds,true)->where("userId",Auth::id())->get();
				
				$accounts[$key]->zaps_count = !empty($zaps_count)?$zaps_count[0]->total:0;
			}
		}
		
		$AppIdsw = '%\"AppId\":\"'.$slug.'\"%';
				
		$zaps = DB::select("select * from `zaps` where `zapData` LIKE '$AppIdsw' and  `userId` = $user_id");
      $app_data = AppsData::where('AppId', $slug)->first();
		
		return view("App.connection_apps", compact('accounts','zaps','slug','app_data'));
    }
	
		public function connections_data($slug)
    {
		$user_id =Auth::id();
		
		$AppIdsw = '%\"AppId\":\"'.$slug.'\"%';
				
		$zaps = DB::select("select * from `zaps` where `zapData` LIKE '$AppIdsw' and  `userId` = $user_id");
		$app_data = AppsData::where('AppId', $slug)->first();
				
		return view("App.connections_data", compact('zaps','slug','app_data'));
    }
	
    public function zaps()
    {
        return view("App.Pages.Zaps");
    }

    public function zapsDetails($id, $data)
    {
        $zap = Zap::find($id);
        if ($zap) {
            return view("App.Pages.ZapsDetails", compact('zap', 'data'));
        }
        return redirect()->route('home');
    }

    public function oneAppSelected($first)
    {
        if ($apps = AppsData::where('AppId', $first)->first()) {
            return view('App.Apps', compact('apps'));
        }
        Notification::setNotification(Helpers::translate('Your AppId is not Valid'), Helpers::translate('Please try another App'), 'warning', 'bottom');
        return redirect()->route('Apps.index');
    }

    public function twoAppsSelected($first, $second)
    {
        if (!AppsData::where('AppId', $first)->first()) {
            Notification::setNotification(Helpers::translate('Your AppId is not Valid'), Helpers::translate('Please try another App'), 'warning', 'bottom');
            return redirect()->route('Apps.index');
        }
        if (!AppsData::where('AppId', $second)->first()) {
            Notification::setNotification(Helpers::translate('Your AppId is not Valid'), Helpers::translate('Please try another App'), 'warning', 'bottom');
            return redirect()->route('Apps.index');
        }
        $firstApp = new AppInfo($first);
        if(isset($firstApp->appClass->dataOptionTrigger)){
            Notification::setNotification(Helpers::translate('Your AppId is not Valid'), Helpers::translate('Please try another App'), 'warning', 'bottom');
            return redirect()->route('Apps.index');
        }
        $secondApp = new AppInfo($second);
        if(isset($secondApp->appClass->dataOptionAction)){
            Notification::setNotification(Helpers::translate('Your AppId is not Valid'), Helpers::translate('Please try another App'), 'warning', 'bottom');
            return redirect()->route('Apps.index');
        }

        return view("App.Connect", compact('firstApp', 'secondApp'));

    }
	 public function threeAppsSelected($first, $filter,$second)
    {
        if (!AppsData::where('AppId', $first)->first()) {
            Notification::setNotification(Helpers::translate('Your AppId is not Valid'), Helpers::translate('Please try another App'), 'warning', 'bottom');
            return redirect()->route('Apps.index');
        }
        if (!AppsData::where('AppId', $second)->first()) {
            Notification::setNotification(Helpers::translate('Your AppId is not Valid'), Helpers::translate('Please try another App'), 'warning', 'bottom');
            return redirect()->route('Apps.index');
        }
        $firstApp = new AppInfo($first);
        if(isset($firstApp->appClass->dataOptionTrigger)){
            Notification::setNotification(Helpers::translate('Your AppId is not Valid'), Helpers::translate('Please try another App'), 'warning', 'bottom');
            return redirect()->route('Apps.index');
        }
        $secondApp = new AppInfo($second);
        if(isset($secondApp->appClass->dataOptionAction)){
            Notification::setNotification(Helpers::translate('Your AppId is not Valid'), Helpers::translate('Please try another App'), 'warning', 'bottom');
            return redirect()->route('Apps.index');
        }
		$filter = $filter;

        return view("App.ConnectFilter", compact('firstApp','filter', 'secondApp'));

    }
}
