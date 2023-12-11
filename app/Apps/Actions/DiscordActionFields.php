<?php

namespace App\Apps\Actions;

use App\Apps\Discord;
use App\Http\Controllers\Api\Apps\Manager;
use App\Logic\Helpers;
use App\Models\Account;

class DiscordActionFields
{
    function __construct($accountId = 0)
    {
        $this->mainClass = new Discord();
        if ($accountId != 0) {
            $this->account = Account::find($accountId);
            $this->mainClass = new Discord();
            $this->userId = $this->mainClass->getUserId();
            $this->access_token = $this->mainClass->getToken($accountId);
        }
    }
    public function new_user_added($data)
    {
        // Labels
        $actionAccount = $data['action']['account_id'];
        $drive = new Discord;
        $accessToken = $drive->getToken($actionAccount);
        $api_endpoint = $drive->getApiEndpoint($actionAccount);
        $organizations = $drive->listLists($api_endpoint.'/3.0/lists/',$accessToken, ['memberId' => $drive->getUserId()]);
        $form = [];
			$organizations  = $organizations['lists'];
        foreach ($organizations as $key1 => $value1) {
            $form['Custom']['string'][] = [
                'id' => "idAudience/24110/" . $value1['id'],
                'name' => $value1['name']
            ];
        }

        // Labels
        $id = rand(0, 4548575451);


        $view = view('App.Actions.Fields.Input', [
            'form' => $form,
            'id' => $id,
            'label' => "Select Audience",
            'labelId' => "idAudience",
            'multiple' => false
        ])->render();
        $views[] = $view;

        $scripts[] = view('App.Actions.Fields.Script', [
            'form' => $form,
            'id' => $id,
            'labelId' => "idAudience",
            'labelName' => "Select Audience",
        ])->render();


        $dataV = json_decode(json_encode($data, true), true);
        $manager = new Manager;
        $api_fields = $manager->getTriggerValue($dataV);
        $form = [];
	
      $form['Custom']['custom'][] = [
            'id' => 'custom',
            'name' => Helpers::translate('Add Custom')
        ];
          if (isset($api_fields['string'])) {
            foreach ($api_fields['string'] as $key1 => $value1) {
                $form['Api']['api'][] = [
                    'id' => "name/24110/" . $key1,
                    'name' => $key1
                ];
            }
        }
		
        // Labels
        $id = rand(0, 4548575451);


        $view = view('App.Actions.Fields.Input', [
            'form' => $form,
            'id' => $id,
            'label' => "Email",
            'labelId' => "email",
        ])->render();
        $views[] = $view;

        $scripts[] = view('App.Actions.Fields.Script', [
            'form' => $form,
            'id' => $id,
            'labelId' => "email",
            'labelName' => "Email",
        ])->render();
		

        $view = Helpers::rap_with_form($views, $data);


        return [
            'view' => $view,
            'script' => $scripts,
            'message' => Helpers::translate('Connected With Data Fields'),
            'status' => 200,
        ];

    }


    
}
