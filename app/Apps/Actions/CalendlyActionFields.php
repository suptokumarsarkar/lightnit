<?php

namespace App\Apps\Actions;

use App\Apps\Calendly;
use App\Http\Controllers\Api\Apps\Manager;
use App\Logic\Helpers;
use App\Models\Account;

class CalendlyActionFields
{
    function __construct($accountId = 0)
    {
        $this->mainClass = new Calendly();
        if ($accountId != 0) {
            $this->account = Account::find($accountId);
            $this->mainClass = new Calendly();
            $this->userId = $this->mainClass->getUserId();
            $this->access_token = $this->mainClass->getToken($accountId);
        }
    }

    public function invitee_canceled($data)
    {
        // Labels
        $actionAccount = $data['action']['account_id'];
        $drive = new Calendly;
        $accessToken = $drive->getToken($actionAccount);
        $organizations = $drive->listOrganizations($accessToken, ['memberId' => $drive->getUserId()]);
        $form = [];

        foreach ($organizations as $key1 => $value1) {
            $form['Custom']['string'][] = [
                'id' => "idOrganization/24110/" . $value1['id'],
                'name' => $value1['name']
            ];
        }

        // Labels
        $id = rand(0, 4548575451);


        $view = view('App.Actions.Fields.Input', [
            'form' => $form,
            'id' => $id,
            'label' => "Select Organization",
            'labelId' => "idOrganization",
            'multiple' => false
        ])->render();
        $views[] = $view;

        $scripts[] = view('App.Actions.Fields.Script', [
            'form' => $form,
            'id' => $id,
            'labelId' => "idOrganization",
            'labelName' => "Select Organization",
        ])->render();

//BCC
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
            'label' => "Title",
            'labelId' => "name",
        ])->render();
        $views[] = $view;

        $scripts[] = view('App.Actions.Fields.Script', [
            'form' => $form,
            'id' => $id,
            'labelId' => "name",
            'labelName' => "Title",
        ])->render();


        $form = [];
        $form['Custom']['custom'][] = [
            'id' => 'custom',
            'name' => Helpers::translate('Add Custom')
        ];
        if (isset($api_fields['string'])) {
            foreach ($api_fields['string'] as $key1 => $value1) {
                $form['Api']['api'][] = [
                    'id' => "desc/24110/" . $key1,
                    'name' => $key1
                ];
            }
        }
        // Labels
        $id = rand(0, 4548575451);


        $view = view('App.Actions.Fields.Input', [
            'form' => $form,
            'id' => $id,
            'label' => "Description",
            'labelId' => "desc",
        ])->render();
        $views[] = $view;

        $scripts[] = view('App.Actions.Fields.Script', [
            'form' => $form,
            'id' => $id,
            'labelId' => "desc",
            'labelName' => "Description",
        ])->render();


        $form = [];
        $id = rand(0, 4548575451);

        $form['Custom']['string'][] = [
            'id' => "prefs_permissionLevel/24110/org",
            'name' => 'ORG'
        ];
        $form['Custom']['string'][] = [
            'id' => "prefs_permissionLevel/24110/private",
            'name' => 'Private'
        ];
        $form['Custom']['string'][] = [
            'id' => "prefs_permissionLevel/24110/public",
            'name' => 'Public'
        ];

        $view = view('App.Actions.Fields.Input', [
            'form' => $form,
            'id' => $id,
            'label' => "Permission Level",
            'labelId' => "prefs_permissionLevel",
            'multiple' => false
        ])->render();
        $views[] = $view;

        $view = Helpers::rap_with_form($views, $data);


        return [
            'view' => $view,
            'script' => $scripts,
            'message' => Helpers::translate('Connected With Data Fields'),
            'status' => 200,
        ];

    }

    public function invitee_created($accountId, $mainData, $data)
    {
        $this->account = Account::find($accountId);
        $this->mainClass = new Trello;
        $this->userId = $this->mainClass->getUserId();

        $this->access_token = $this->mainClass->getToken($accountId);
        if (isset($mainData['name'])) {
            $params = [
                'name' => Helpers::stringorexplode($mainData['name']),
                'desc' => Helpers::stringorexplode($mainData['desc']),
                'idOrganization' => Helpers::stringorsingle($mainData['idOrganization']),
                'prefs_permissionLevel' => Helpers::stringorsingle($mainData['prefs_permissionLevel']),
            ];
            $this->mainClass->createBoard($this->access_token, $params);

            return json_encode([
                'status' => 200,
                'message' => Helpers::translate('Successfully Applied First Nit')
            ]);
        } else {
            return json_encode([
                'status' => 400,
                'message' => Helpers::translate('Failed to Process your request.')
            ]);

        }
    }

}
