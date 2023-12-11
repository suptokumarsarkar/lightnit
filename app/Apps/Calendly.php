<?php

namespace App\Apps;

use App\Apps\Triggers\TrelloTrigger;
use App\Logic\Helpers;
use App\Models\Account;
use App\Models\AppsData;

class Calendly
{

//    private $client_id = '68667692288-4bkagbc71fb2k0c9dr481ip9ib22iffv.apps.googleusercontent.com';
//    private $client_secret = "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";

    /**
     * @var mixed
     */
    public $client_id;
    /**
     * @var mixed
     */
    public $client_secret;

    public function __construct()
    {
        $gmail = AppsData::where("AppId", "Calendly")->first();
        if ($gmail) {
            $appInfo = json_decode($gmail->AppInfo, true);
            $this->client_id = $appInfo['api_key'];
            $this->client_secret = $appInfo['secret'];
        }
    }

    public function addAccount($data = [])
    {
        
        $access_token = "";
		if (isset($data['token']['code'])) {
		  $url = 'https://auth.calendly.com/oauth/token';
		  $context = stream_context_create([
			'http' => [
			  'header' => "Content-type: application/x-www-form-urlencoded\r\n",
			  'method' => 'POST',
			  'content' => http_build_query([
				'grant_type' => "authorization_code",
				'client_id' => $this->client_id,
				'client_secret' => $this->client_secret,
				'redirect_uri' => "	https://lightnit.com/oauth/Calendly",
				'code' => $data['token']['code'],
			  ])
			]
		  ]);
		  $result = file_get_contents($url, false, $context);
        
		  $decoded = json_decode($result);
		  $access_token = $decoded->access_token;
		}
		$data = array_merge($data,array('token'=>$access_token));
	
        return json_encode($data);
    }

    public function getProfile($data = [], $tokenGroup = [])
    {
           

        $access_token = "";
		if (isset($data['token']['code'])) {
            $url = 'https://auth.calendly.com/oauth/token';
		
		  $context = stream_context_create([
			'http' => [
			  'header' => "Content-type: application/x-www-form-urlencoded\r\n",
			  'method' => 'POST',
			  'content' => http_build_query([
				'grant_type' => "authorization_code",
				'client_id' => $this->client_id,
				'client_secret' => $this->client_secret,
                'redirect_uri' => "	https://lightnit.com/oauth/Calendly",
				'code' => $data['token']['code'],
			  ]),
			],
		  ]);
		  $result = file_get_contents($url, false, $context);
		  $decoded = json_decode($result);
		  $access_token = $decoded->access_token;
		}
		
        return json_encode($this->getMember($access_token, ['memberId' => $this->getUserId()]));
    }


    public function getTrigger(): array
    {
        return array(
               [
                'id' => 'invitee_canceled',
                'name' => Helpers::translate('invitee_canceled'),
                'description' => Helpers::translate('Triggers when a invitee canceled is added')
            ],
            [
                'id' => 'invitee_created',
                'name' => Helpers::translate('Invitee Created'),
                'description' => Helpers::translate('Triggers when a invitee created is added')
            ]
          
        );
    }

    public function getActions(): array
    {
        return array(
          
        );
    }


    public function getToken($id)
    {
        $getProfile = Account::find($id);
        $token = json_decode($getProfile->token, true);
        return $token['token'];
    }

    public function getUserId($actionAccount = null)
    {
        return 'me';
    }

    public function getCheckupData($accountId, $labelId)
    {
        $getProfile = Account::find($accountId);
        $data = json_decode($getProfile->data, true);
        $access_token = $this->getToken($accountId);
        $trigger = new TrelloTrigger($accountId);
        return [
            'access_token' => $access_token,
            'view' => $trigger->$labelId(),
        ];
    }

    public function checkAccount($id)
    {
        if ($access_token = $this->getToken($id)) {
            $url = "https://www.googleapis.com/oauth2/v3/userinfo?access_token=" . $access_token;

            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $response = curl_exec($ch);
            $profile = json_decode($response, 1);

            if (isset($profile) && count($profile) != 0) {
                return true;
            }
        }
        return false;
    }

    public function fileManagerInstance($accountId)
    {
        return [$this->getToken($accountId)];
    }


    // Default API
    public function getMember($access_token, $param)
    {
        $url = "https://api.calendly.com/users";
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_HTTPHEADER,  array(
		"Authorization: Bearer ".$access_token."",
	  ));
		
      $response = curl_exec($ch);
      return json_decode($response, true);
    }


    // Boards Api
    public function listBoards($access_token, $param)
    {
        $url = "https://api.calendly.com/1/members/{$param['memberId']}/boards?key={$this->client_id}&token=" . $access_token;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        return json_decode($response, true);
    }

    public function getBoard($access_token, $param)
    {
        $url = "https://api.calendly.com/1/boards/{$param['id']}?key={$this->client_id}&token=" . $access_token;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        return json_decode($response, true);
    }

    public function createBoard($access_token, $param)
    {
        $params = [
            'name' => $param['name'],
            'idOrganization ' => $param['idOrganization'],
            'desc' => $param['desc'],
            'prefs_permissionLevel' => $param['prefs_permissionLevel'],
            'key' => $this->client_id,
            'token' => $access_token,
        ];
        $url = "https://api.calendly.com/1/boards";
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization: Bearer " . $access_token, 'Accept: application/json', 'Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params, true));
        $data = curl_exec($ch);

        return json_decode($data, true);
    }

    public function deleteBoard($access_token, $param)
    {
        $params = [
            'key' => $this->client_id,
            'token' => $access_token,
        ];
        $url = "https://api.calendly.com/1/boards/{$param['id']}";
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization: Bearer " . $access_token, 'Accept: application/json', 'Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params, true));
        $data = curl_exec($ch);
        return json_decode($data, true);
    }

    public function closeBoard($access_token, $param)
    {
        $params = [
            'closed' => true,
            'key' => $this->client_id,
            'token' => $access_token,
        ];
        $url = "https://api.calendly.com/1/boards/{$param['id']}";
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization: Bearer " . $access_token, 'Accept: application/json', 'Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params, true));
        $data = curl_exec($ch);
        return json_decode($data, true);
    }

    // Organizations
    public function listOrganizations($access_token, $param)
    {
        $url = "https://api.calendly.com/1/members/{$param['memberId']}/organizations?key={$this->client_id}&token=" . $access_token;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        return json_decode($response, true);
    }


    // Lists
    public function listLists($access_token, $param)
    {
        $url = "https://api.calendly.com/1/boards/{$param['boardId']}/lists?key={$this->client_id}&token=" . $access_token;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        return json_decode($response, true);
    }
    public function listMembers($access_token, $param)
    {
        $url = "https://api.calendly.com/1/boards/{$param['boardId']}/members?key={$this->client_id}&token=" . $access_token;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        return json_decode($response, true);
    }

    public function getLists($access_token, $param)
    {
        $url = "https://api.calendly.com/1/lists/{$param['id']}?key={$this->client_id}&token=" . $access_token;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        return json_decode($response, true);
    }

    public function createList($access_token, $param)
    {
        $params = [
            'name' => $param['name'],
            'idBoard' => $param['idBoard'],
            'pos' => $param['pos'],
            'key' => $this->client_id,
            'token' => $access_token,
        ];
        $url = "https://api.calendly.com/1/lists";
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization: Bearer " . $access_token, 'Accept: application/json', 'Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params, true));
        $data = curl_exec($ch);

        return json_decode($data, true);
    }

    // Card APIs

    public function listCards($access_token, $param)
    {
        $url = "https://api.calendly.com/1/lists/{$param['listId']}/cards?key={$this->client_id}&token=" . $access_token;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        return json_decode($response, true);
    }

    public function listCardsByBoards($access_token, $param)
    {
        $url = "https://api.calendly.com/1/boards/{$param['boardId']}/cards/all?key={$this->client_id}&token=" . $access_token;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        return json_decode($response, true);
    }

    public function getCard($access_token, $param)
    {
        $url = "https://api.calendly.com/1/cards/{$param['cardId']}?key={$this->client_id}&token=" . $access_token;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        return json_decode($response, true);
    }

    public function createCard($access_token, $param)
    {
        $params = [
            'name' => $param['name'],
            'idBoard' => $param['idBoard'],
            'idList' => $param['idList'],
            'desc' => $param['desc'],
            'address' => $param['address'],
            'start' => $param['start'],
            'due' => $param['due'],
            'locationName' => $param['locationName'],
            'key' => $this->client_id,
            'token' => $access_token,
        ];
        $url = "https://api.calendly.com/1/cards";
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization: Bearer " . $access_token, 'Accept: application/json', 'Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params, true));
        $data = curl_exec($ch);

        return json_decode($data, true);
    }


    public function updateCard($access_token, $param)
    {
        $params = [
            'name' => $param['name'],
            'idBoard' => $param['idBoard'],
            'idList' => $param['idList'],
            'desc' => $param['desc'],
            'address' => $param['address'],
            'start' => $param['start'],
            'due' => $param['due'],
            'locationName' => $param['locationName'],
            'key' => $this->client_id,
            'token' => $access_token,
        ];
        $url = "https://api.calendly.com/1/cards/{$param['id']}";
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization: Bearer " . $access_token, 'Accept: application/json', 'Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params, true));
        $data = curl_exec($ch);
        return json_decode($data, true);
    }

    public function archiveCard($access_token, $param)
    {
        $params = [
            'closed' => true,
            'key' => $this->client_id,
            'token' => $access_token,
        ];
        $url = "https://api.calendly.com/1/cards/{$param['id']}";
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization: Bearer " . $access_token, 'Accept: application/json', 'Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params, true));
        $data = curl_exec($ch);
        return json_decode($data, true);
    }

    public function addAttachmentToCard($access_token, $param)
    {
        $params = [
            'name' => $param['name'],
            'mimeType' => $param['mimeType'],
            'url' => $param['url'],
            'setCover' => $param['setCover'],
        ];
        if (isset($param['file']['dataDecode'])) {
            define('MULTIPART_BOUNDARY', '--------------------------' . rand() . time());
            $content = "--" . MULTIPART_BOUNDARY . "\r\n" .
                "Content-Disposition: form-data; name=\"file\"; filename=\"" . $param['name'] . "\"\r\n" .
                "Content-Type: {$param['mimeType']}\r\n\r\n" .
                $param['file']['dataDecode'] . "\r\n";
            $content .= "--" . MULTIPART_BOUNDARY . "--\r\n";
        }

        $url = "https://api.calendly.com/1/cards/{$param['id']}/attachments?key={$this->client_id}&token={$access_token}&" . http_build_query($params);
        $ch = curl_init($url);

        file_put_contents($param['name'], $param['file']['dataDecode']);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: multipart/form-data; boundary=' . MULTIPART_BOUNDARY));
        curl_setopt($ch, CURLOPT_POSTFIELDS, isset($param['file']['dataDecode']) ? $content : '');
        $data = curl_exec($ch);
        return json_decode($data, true);
    }

    public function getAttachments($access_token, $param)
    {
        $url = "https://api.calendly.com/1/cards/{$param['id']}/attachments?key={$this->client_id}&token=" . $access_token;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        return json_decode($response, true);
    }

    // Label APIs
    public function getLabels($access_token, $param)
    {
        $url = "https://api.calendly.com/1/boards/{$param['boardId']}/labels?key={$this->client_id}&token=" . $access_token;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        return json_decode($response, true);
    }
    public function createLabel($access_token, $param)
    {
        $params = [
            'name' => $param['name'],
            'idBoard' => $param['idBoard'],
            'color' => $param['color'],
            'key' => $this->client_id,
            'token' => $access_token,
        ];
        $url = "https://api.calendly.com/1/labels";
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization: Bearer " . $access_token, 'Accept: application/json', 'Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params, true));
        $data = curl_exec($ch);
        return json_decode($data, true);
    }

    public function addLabelToCard($access_token, $param)
    {
        $params = [
            'value' => $param['labelId'],
            'key' => $this->client_id,
            'token' => $access_token,
        ];
        $url = "https://api.calendly.com/1/cards/{$param['id']}/idLabels";
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization: Bearer " . $access_token, 'Accept: application/json', 'Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params, true));
        $data = curl_exec($ch);
        return json_decode($data, true);
    }

    public function labelColors()
    {
        return explode(", ", "yellow, purple, blue, red, green, orange, black, sky, pink, lime");
    }

    public function createCheckListItemOnCard($access_token, $param)
    {
        $params = [
            'name' => $param['name'],
            'pos' => $param['pos'],
            'key' => $this->client_id,
            'token' => $access_token,
        ];
        $url = "https://api.calendly.com/1/cards/{$param['id']}/checklists";
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization: Bearer " . $access_token, 'Accept: application/json', 'Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params, true));
        $data = curl_exec($ch);
        return json_decode($data, true);
    }

}
