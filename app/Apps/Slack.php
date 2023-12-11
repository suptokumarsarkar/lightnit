<?php

namespace App\Apps;

use App\Apps\Triggers\TrelloTrigger;
use App\Logic\Helpers;
use App\Models\Account;
use App\Models\AppsData;

class Slack
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
        $slack_app = AppsData::where("AppId", "Slack")->first();
        if ($slack_app) {
            $appInfo = json_decode($slack_app->AppInfo, true);
            $this->client_id = $appInfo['api_key'];
            $this->client_secret = $appInfo['secret'];
        }
    }

    public function addAccount($data = [])
    {
        return json_encode($data);
    }

    public function getProfile($data = [], $tokenGroup = [])
    {
        return json_encode($this->getMember($data['token'], ['memberId' => $this->getUserId()]));
    }


    public function getTrigger(): array
    {
        return array(
            [
                'id' => 'new_file',
                'name' => Helpers::translate('New File'),
                'description' => Helpers::translate('Triggers when a new file is added')
            ],
            [
                'id' => 'new_mention',
                'name' => Helpers::translate('New Mention'),
                'description' => Helpers::translate('Triggers when a new mention is added')
            ],
            [
                'id' => 'new_message_posted_to_private_channel',
                'name' => Helpers::translate('New Message Posted To Private Channel'),
                'description' => Helpers::translate('Triggers when a new message posted to private channel in slack')
            ],
            [
                'id' => 'new_pushed_message',
                'name' => Helpers::translate('New Pushed Message'),
                'description' => Helpers::translate('Triggers when a new pushed message is created in slack')
            ],
            [
                'id' => 'new_reaction_added',
                'name' => Helpers::translate('New Reaction Added'),
                'description' => Helpers::translate('Triggers when a new reaction added is created')
            ],
            [
                'id' => 'new_team_custom_emoji',
                'name' => Helpers::translate('New Team Custom Emoji'),
                'description' => Helpers::translate('Triggers when a new team custom emoji is created in a slack')
            ],
            [
                'id' => 'new_user',
                'name' => Helpers::translate('New User In slack'),
                'description' => Helpers::translate('Triggers when a new user is added to a slack')
            ],
            [
                'id' => 'new_channel',
                'name' => Helpers::translate('New Channel In slack'),
                'description' => Helpers::translate('Triggers when a new channel is added to a slack')
            ],
            [
                'id' => 'new_message_posted_to_channel',
                'name' => Helpers::translate('New Message Posted To Channel In slack'),
                'description' => Helpers::translate('Triggers when a new message posted to channels added to a slack')
            ],
            [
                'id' => 'new_public_message_posted_anywhere',
                'name' => Helpers::translate('New Public Message Posted Anywhere In slack'),
                'description' => Helpers::translate('Triggers when a new public message posted anywhere is added to a slack')
            ],
            [
                'id' => 'new_saved_message',
                'name' => Helpers::translate('New Saved Message In slack'),
                'description' => Helpers::translate('Triggers when a new saved message is added to a slack')
            ]
           
   
        );
    }

    public function getActions(): array
    {
        return array(
            [
                'id' => 'create_channel',
                'name' => Helpers::translate('Create Channel'),
                'description' => Helpers::translate('Creates a new Channel')
            ],
            [
                'id' => 'add_reminder',
                'name' => Helpers::translate('Create Reminder'),
                'description' => Helpers::translate('Creates a new Reminder')
            ]
          
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
        $url = "https://api.trello.com/1/members/{$param['memberId']}/?key={$this->client_id}&token=" . $access_token;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        return json_decode($response, true);
    }


    // Boards Api
    public function listBoards($access_token, $param)
    {
        $url = "https://api.trello.com/1/members/{$param['memberId']}/boards?key={$this->client_id}&token=" . $access_token;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        return json_decode($response, true);
    }

    public function getBoard($access_token, $param)
    {
        $url = "https://api.trello.com/1/boards/{$param['id']}?key={$this->client_id}&token=" . $access_token;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        return json_decode($response, true);
    }

   

}
