<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Logic\Helpers;
use App\Models\Account;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Plan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Api\Apps\Manager;

class GoogleAuth extends Controller 
{
   // private $client_id = '296939156769-62ktmdt3s7g6am6llqm71mej7ab4hc1n.apps.googleusercontent.com';
   // private $client_id = '310344042960-nkihntqro67jlteolcj8bi4a0uhipapu.apps.googleusercontent.com';
   // private $client_secret = "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";
   // private $client_secret = "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";

	 private $client_id = '151365713016-maf2rruev1vt261m7n0bg1v9eca4grua.apps.googleusercontent.com';
    private $client_secret = "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";
   
    public function login(Request $request)
    {
        $googleId = $request->sub;
        $user = User::where("googleId", $googleId)->first();

        if (!$user) {
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make(rand());
            $user->googleId = $googleId;
            $user->email_verified_at = time();
            $extra_data = [];
            if ($request->picture) {
                $image = Helpers::uploadFile('/profile/', 'png', $request->picture, 'file' . rand());
                $extra_data['picture'] = $image;
            }

            $user->user_data = json_encode($extra_data, 1);
            $user->save();
			$user_id = $user->id;
			
			 $plan = Plan::where("id",1)->first();
			 $manager = new Manager;
			 $manager->updateZaps($user_id,$plan->maxConnections,$plan->taskPerMonth);
			 
        }
        if (Auth::loginUsingId($user->id, false)) {
            return new Response([
                [
                    'status' => 200,
                    'message' => Helpers::translate('Login Success'),
                    'RememberToken' => $user->getRememberToken(),
                    'id' => $user->id,
                    'user' => $user,
                ]
            ]);
        } else {
            return new Response([
                [
                    'status' => 400,
                    'message' => Helpers::translate('Login Failed'),
                ], 400
            ]);
        }
    }

    function oauthApp($appId, Request $request)
    {
        $data = json_encode([
            'app_id' => $appId,
            'data' => $request->all()
        ]);
        return '<textarea id="token" style="display:none">'.$data .'</textarea> Redirecting..';
    }
	
	
	  function redirect($appId, Request $request)
    {
        $data = json_encode([
            'app_id' => $appId,
            'data' => $request->all()
        ]);
        return '<textarea id="token" style="display:none">'.$data .'</textarea> Redirecting..';
    }

    public function googleToken(Request $request)
    {
        $data = [
            'code' => $request->code,
            'client_id' => $this->client_id,
            'client_secret' => $this->client_secret,
            'redirect_uri' => "https://lightnit.com/oauth/redirect",
            'grant_type' => 'authorization_code'
        ];

        $url = "https://oauth2.googleapis.com/token";

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

// execute!
        $response = curl_exec($ch);
	
        return json_decode($response, 1);

    }

    public function createProfile(Request $request)
    {
 
        $tokenGroup = $this->googleToken($request);

        $url = "https://www.googleapis.com/oauth2/v3/userinfo?access_token=" . $tokenGroup['access_token'];

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// execute!
        $response = curl_exec($ch);
        $profile = json_decode($response, 1);

        // Create Topic
        /*$topic_name = "projects/tor-messenger/topics/gmail";

        $topicData = [
            "labelIds" => ["INBOX"],
            "topicName" => $topic_name,
        ];

        $ch = curl_init("https://gmail.googleapis.com/gmail/v1/users/".$profile['sub']."/stop");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization: Bearer ".$tokenGroup['access_token'], 'Accept: application/json', 'Content-Type: message/rfc822'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([]));
        $data = curl_exec($ch);

        $ch = curl_init("https://gmail.googleapis.com/gmail/v1/users/".$profile['sub']."/watch");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization: Bearer ".$tokenGroup['access_token'], 'Accept: application/json', 'Content-Type: message/rfc822'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($topicData));
        $data = curl_exec($ch);*/

        $account = new Account;
        $account->accountId = Auth::id();
        $account->token = json_encode($tokenGroup);
        $account->data = json_encode($profile);
        $account->type = $request->type;
        if ($account->save()) {
            return json_encode([
                'status' => 200,
                'message' => Helpers::translate('Account Added Successfully.'),
                'access_token' => $tokenGroup['access_token']
            ]);
        } else {
            return json_encode([
                'status' => 400,
                'message' => Helpers::translate("Something went wrong. Please try again.")
            ]);
        }
    }

    public function getRefreshToken($refreshToken)
    {
        $data = [
            'refresh_token' => $refreshToken,
            'client_id' => $this->client_id,
            'client_secret' => $this->client_secret,
            'grant_type' => 'refresh_token'
        ];

        $url = "https://oauth2.googleapis.com/token";

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

// execute! 
        $response = curl_exec($ch);
        return json_decode($response, 1);
    }

    public function getToken($id)
    {
        $getProfile = Account::find($id);
        $token = json_decode($getProfile->token, true);
        $refreshToken = $this->getRefreshToken($token['refresh_token']);
        return $refreshToken['access_token'];
    }
}
