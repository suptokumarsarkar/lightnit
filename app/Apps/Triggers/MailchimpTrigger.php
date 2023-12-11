<?php

namespace App\Apps\Triggers;

use App\Apps\Mailchimp;
use App\Http\Controllers\Api\Apps\Manager;
use App\Logic\Helpers;
use App\Models\Account;

class MailchimpTrigger
{
    private $account;
    /**
     * @var Mailchimp
     */
    private $mainClass;
    /**
     * @var mixed
     */
    private $access_token;

    function __construct($accountId)
    {
        $this->account = Account::find($accountId);
        $this->mainClass = new Mailchimp;
        $this->userId = $this->mainClass->getUserId();
        $this->access_token = $this->mainClass->getToken($accountId);
        $this->api_endpoint = $this->mainClass->getApiEndpoint($accountId);
    }

    public function new_board()
    {
        return [
            'view' => Helpers::translate('Will be fired when a new board is created. Your account has been selected. Click \'Check Action\' Button to go on.'),
            'script' => '',
            'message' => Helpers::translate('Connected With Trello'),
            'status' => 200,
        ];
    }

    public function new_board_check($data = [])
    {
        $files = $this->mainClass->listLists($this->access_token, ['memberId' =>$this->mainClass->getUserId()]);
        $dataString['string'] = $files[count($files) - 1];
        return $dataString;
    }

//    New subscriber
    public function new_subscriber(): array
    {
        $actionAccount = $this->account;
		
        $organizations = $this->mainClass->listLists($this->api_endpoint.'/3.0/lists/',$this->access_token, ['memberId' => $this->mainClass->getUserId()]);
        $form = [];
		$organizations  = $organizations['lists'];
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
            'label' => "Select Audience",
            'labelId' => "idAudience",
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
            'labelName' => Helpers::translate('Audience'),
        ])->render();

        return [
            'view' => $view,
            'script' => $scripts,
            'message' => Helpers::translate('Connected With Tasks'),
            'status' => 200,
        ];
    }
	
	 public function new_subscriber_check($data = []): array
    {
        $data = Helpers::IllitarableArray($data);
        $value = Helpers::evaluteData($data);
        
        $filesData = $this->mainClass->getLabels($this->api_endpoint.'/3.0/lists/'.$value['string']['idBoard'][0],$this->access_token);
        
		$dataString['string'] = $filesData['_links'];
        return $dataString;
    }


	//    New subscriber
    public function new_unsubscriber(): array
    {
        $actionAccount = $this->account;
		
        $organizations = $this->mainClass->listLists($this->api_endpoint.'/3.0/lists/',$this->access_token, ['memberId' => $this->mainClass->getUserId()]);
        $form = [];
		$organizations  = $organizations['lists'];
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
            'label' => "Select Audience",
            'labelId' => "idAudience",
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
            'labelName' => Helpers::translate('Audience'),
        ])->render();

        return [
            'view' => $view,
            'script' => $scripts,
            'message' => Helpers::translate('Connected With Tasks'),
            'status' => 200,
        ];
    }
	
	 public function new_unsubscriber_check($data = []): array
    {
        $data = Helpers::IllitarableArray($data);
        $value = Helpers::evaluteData($data);
        
        $filesData = $this->mainClass->getLabels($this->api_endpoint.'/3.0/lists/'.$value['string']['idBoard'][0],$this->access_token);
        
		$dataString['string'] = $filesData['_links'];
        return $dataString;
    }




//    New Labels
    public function new_label(): array
    {
        $actionAccount = $this->account;

        $organizations = $this->mainClass->listBoards($this->access_token, ['memberId' => $this->mainClass->getUserId()]);
        $lists = $this->mainClass->listCardsByBoards($this->access_token, ['boardId' => $organizations[0]['id']]);
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


    public function new_label_check($data = []): array
    {
        $data = Helpers::IllitarableArray($data);
        $value = Helpers::evaluteData($data);
        $param = [
            'boardId' => $value['string']['idBoard'][0]
        ];
        $filesData = $this->mainClass->getLabels($this->access_token, $param);
        $dataString['string'] = $filesData[count($filesData) - 1];
        return $dataString;
    }


 
//    New Lists
    public function new_list(): array
    {
        $actionAccount = $this->account;

        $organizations = $this->mainClass->listBoards($this->api_endpoint,$this->access_token, ['memberId' => $this->mainClass->getUserId()]);
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


    public function new_list_check($data = []): array
    {
        $data = Helpers::IllitarableArray($data);
        $value = Helpers::evaluteData($data);
        $param = [
            'boardId' => $value['string']['idBoard'][0]
        ];
        $filesData = $this->mainClass->listLists($this->access_token, $param);
        $dataString['string'] = $filesData[count($filesData) - 1];
        return $dataString;
    }




//    New Members
    public function new_member(): array
    {
        $actionAccount = $this->account;

        $organizations = $this->mainClass->listBoards($this->access_token, ['memberId' => $this->mainClass->getUserId()]);
        $lists = $this->mainClass->listCardsByBoards($this->access_token, ['boardId' => $organizations[0]['id']]);
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
