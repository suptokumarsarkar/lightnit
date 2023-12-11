<?php

namespace App\Apps\Triggers;

use App\Apps\Calendly;
use App\Http\Controllers\Api\Apps\Manager;
use App\Logic\Helpers;
use App\Models\Account;

class AirtableTrigger
{
    private $account;
    /**
     * @var Calendly
     */
    private $mainClass;
    /**
     * @var mixed
     */
    private $access_token;

    function __construct($accountId)
    {
        $this->account = Account::find($accountId);
        $this->mainClass = new Airtable;
        $this->userId = $this->mainClass->getUserId();
        $this->access_token = $this->mainClass->getToken($accountId);
        $this->api_endpoint = "";
    }





//    invitee created
    public function new_update_record(): array
    {
		echo $this->access_token;
		die;
        $actionAccount = $this->account;

        $organizations = $this->mainClass->listBoards($this->access_token, ['memberId' => $this->mainClass->getUserId()]);
        $form = [];

        foreach ($organizations as $key1 => $value1) {
            $form['Custom']['string'][] = [
                'id' => "idBoard/24110/" . $value1['id'],
                'name' => $value1['name']
            ];
        }

        // Labels
        $id = rand(0, 4548575451);


        $view = view('App.Actions.Fields.Input', [
            'form' => $form,
            'id' => $id,
            'label' => "Select Board",
            'labelId' => "idBoard",
            'multiple' => false,
            'required' => true,

        ])->render();

        $views[] = $view;

        $form = [];


        $view = Helpers::rap_with_form($views, [], 'triggerForm');
        $scripts[] = view('App.Actions.Fields.Script', [
            'form' => $form,
            'id' => $id,
            'labelId' => 'cardId',
            'labelName' => Helpers::translate('Card Id'),
        ])->render();

        return [
            'view' => $view,
            'script' => $scripts,
            'message' => Helpers::translate('Connected With Trello'),
            'status' => 200,
        ];
    }


    public function new_member_check($data = []): array
    {
        $data = Helpers::IllitarableArray($data);
        $value = Helpers::evaluteData($data);
        $param = [
            'boardId' => $value['string']['idBoard'][0]
        ];
        $filesData = $this->mainClass->listMembers($this->access_token, $param);
        $dataString['string'] = $filesData[count($filesData) - 1];
        return $dataString;
    }





}
