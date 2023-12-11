<?php

namespace App\Apps\Triggers;

use App\Apps\GoogleForm;
use App\Logic\Helpers;
use App\Models\Account;

class GoogleFormTrigger
{
    private $account;
    /**
     * @var Gmail
     */
    private $mainClass;
    /**
     * @var mixed
     */
    private $access_token;

    function __construct($accountId)
    {
        $this->account = Account::find($accountId);
        $this->userId = json_decode($this->account['data'], true)['sub'];
        $this->mainClass = new GoogleForm;
        $this->access_token = $this->mainClass->getToken($accountId);
    }

    public function new_response(): array
    {
        $files = $this->mainClass->getForms($this->access_token);

        foreach ($files as $file) {
            $form['Custom']['string'][] = [
                'id' => 'form/24110/' . $file['id'],
                'name' => $file['name']
            ];
        }
        $id = rand(0, 4548575451);
        $view[] = view('App.Actions.Fields.Input', [
            'form' => $form,
            'id' => $id,
            'label' => Helpers::translate('Select Form'),
            'required' => true,
            'multiple' => false
        ])->render();
        $view = Helpers::rap_with_form($view, [], 'triggerForm');
        $scripts[] = view('App.Actions.Fields.Script', [
            'form' => $form,
            'id' => $id,
            'labelId' => 'Form',
            'labelName' => Helpers::translate('Form'),
        ])->render();

        return [
            'view' => $view,
            'script' => $scripts,
            'message' => Helpers::translate('Connected With Google Drive'),
            'status' => 200,
        ];

    }


    public function new_response_check($data = [])
    {
        $data = Helpers::IllitarableArray($data);
        $value = Helpers::evaluteData($data);
        $form = $value['string']['form'][0];
        $file = $this->mainClass->getFormResponse($this->access_token, $form);
        if(isset($file['responses'][0])){
            $file = $this->mainClass->getFormResponseWithAnswers($this->access_token, $form, $file['responses'][0]['responseId']);
        }else{
            return [];
        }
		
        return $file;
    }


    public function new_response_changes($zapDatabase = [], $zapData = [])
    {
        $zapDatabase = json_decode($zapDatabase, true)['Files'];
        $zapData = json_decode($zapData, true);
        $data = Helpers::IllitarableArray($zapData['trigger']['Data']);
        $value = Helpers::evaluteData($data);

        $fileData = [];
		$form = $value['string']['form'][0];
        
		$files = $this->mainClass->getFormResponse($this->access_token, $form);
        //$folders = $value['string']['folder'][0];
        //$files = $this->mainClass->getFiles($this->access_token, ['folder' => $folders]);
		//$files['responses'] = array_reverse($files['responses']);

        foreach ($files['responses'] as $file) {
			 
			if (!in_array($file['responseId'], $zapDatabase)) {
                $fileData[] = $this->mainClass->getFormResponseWithAnswers($this->access_token,$form, $file['responseId']);
			}
        }
		
	
        return $fileData;
    }

    public function new_response_update_database($data = null)
    {
        $data = Helpers::IllitarableArray($data);
        $value = Helpers::evaluteData($data);
        $folders = $value['string']['form'][0];
        $files = $this->mainClass->getFormResponse($this->access_token, $folders);

        //$files['responses'] = array_reverse($files['responses']);
        $f = [];
        foreach($files['responses'] as $s){
            $f[] = $s['responseId'];
        }
	  return ['Files' => $f];
    }


}
