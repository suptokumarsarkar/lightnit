<?php

namespace App\Apps\Actions;

use App\Apps\Mailchimp;
use App\Http\Controllers\Api\Apps\Manager;
use App\Logic\Helpers;
use App\Models\Account;

class MailchimpActionFields
{
    function __construct($accountId = 0)
    {
        $this->mainClass = new Mailchimp();
        if ($accountId != 0) {
            $this->account = Account::find($accountId);
            $this->mainClass = new Mailchimp();
            $this->userId = $this->mainClass->getUserId();
            $this->access_token = $this->mainClass->getToken($accountId);
			$this->api_endpoint = $this->mainClass->getApiEndpoint($accountId);
        }
    }

    public function new_subscriber($data)
    {
        // Labels
        $actionAccount = $data['action']['account_id'];
        $drive = new Mailchimp;
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
		
		
		/* $form = [];
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
        $id = rand(0, 4548575451);


        $view = view('App.Actions.Fields.Input', [
            'form' => $form,
            'id' => $id,
            'label' => "First Name",
            'labelId' => "FNAME",
        ])->render();
        $views[] = $view;

        $scripts[] = view('App.Actions.Fields.Script', [
            'form' => $form,
            'id' => $id,
            'labelId' => "FNAME",
            'labelName' => "First Name",
        ])->render();
		
		 $form = [];
      $form['Custom']['custom'][] = [
            'id' => 'custom',
            'name' => Helpers::translate('Add Custom')
        ];
		if (isset($api_fields['string'])) {
            foreach ($api_fields['string'] as $key1 => $value1) {
                $form['Api']['api'][] = [
                    'id' => "name/24110/" . $key1,
                    'name' => 'lastname_'.$key1
                ];
            }
        }
       
        $id = rand(0, 4548575451);


        $view = view('App.Actions.Fields.Input', [
            'form' => $form,
            'id' => $id,
            'label' => "Last Name",
            'labelId' => "LNAME",
        ])->render();
        $views[] = $view;

        $scripts[] = view('App.Actions.Fields.Script', [
            'form' => $form,
            'id' => $id,
            'labelId' => "LNAME",
            'labelName' => "Last Name",
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
                    'name' => $value1['rel']
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
		*/


       // $views[] = $view;

        $view = Helpers::rap_with_form($views, $data);


        return [
            'view' => $view,
            'script' => $scripts,
            'message' => Helpers::translate('Connected With Data Fields'),
            'status' => 200,
        ];

    }
	
	 public function new_subscriber_post($accountId, $mainData, $data)
    {
        $this->account = Account::find($accountId);
        $this->mainClass = new Mailchimp;
        $this->userId = $this->mainClass->getUserId();
		
        $this->access_token = $this->mainClass->getToken($accountId);
		$api_endpoint = $this->mainClass->getApiEndpoint($accountId);
		
        if (isset($mainData['idAudience'])) {
			$list_id = $mainData['idAudience'][count($mainData['idAudience']) - 1];
			if(is_array($mainData['name'])){
			
				foreach($mainData['name'] as $name){
					$params = [
					   'email_address' => $name,
					   'status' => 'subscribed',
						/*'merge_fields'  => array(
							'FNAME' => $mainData['FNAME'][count($mainData['FNAME']) - 1],
							'LNAME' => $mainData['LNAME'][count($mainData['LNAME']) - 1]
						) 
						*/	
					];
					$this->mainClass->addSubscriberToList($api_endpoint.'/3.0/lists/'.$list_id.'/members/', $this->access_token, $params);
			
				}
			} else {
				$params = [
					   'email_address' => $mainData['name'],
					   'status' => 'subscribed',
						/*'merge_fields'  => array(
							'FNAME' => $mainData['FNAME'][count($mainData['FNAME']) - 1],
							'LNAME' => $mainData['LNAME'][count($mainData['LNAME']) - 1]
						) 
						*/	
					];
					$this->mainClass->addSubscriberToList($api_endpoint.'/3.0/lists/'.$list_id.'/members/', $this->access_token, $params);
			}

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

	
    public function unsubscribe_email($data)
    {
        // Labels
        $actionAccount = $data['action']['account_id'];
        $drive = new Mailchimp;
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
		
		
		/* $form = [];
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
        $id = rand(0, 4548575451);


        $view = view('App.Actions.Fields.Input', [
            'form' => $form,
            'id' => $id,
            'label' => "First Name",
            'labelId' => "FNAME",
        ])->render();
        $views[] = $view;

        $scripts[] = view('App.Actions.Fields.Script', [
            'form' => $form,
            'id' => $id,
            'labelId' => "FNAME",
            'labelName' => "First Name",
        ])->render();
		
		 $form = [];
      $form['Custom']['custom'][] = [
            'id' => 'custom',
            'name' => Helpers::translate('Add Custom')
        ];
		if (isset($api_fields['string'])) {
            foreach ($api_fields['string'] as $key1 => $value1) {
                $form['Api']['api'][] = [
                    'id' => "name/24110/" . $key1,
                    'name' => 'lastname_'.$key1
                ];
            }
        }
       
        $id = rand(0, 4548575451);


        $view = view('App.Actions.Fields.Input', [
            'form' => $form,
            'id' => $id,
            'label' => "Last Name",
            'labelId' => "LNAME",
        ])->render();
        $views[] = $view;

        $scripts[] = view('App.Actions.Fields.Script', [
            'form' => $form,
            'id' => $id,
            'labelId' => "LNAME",
            'labelName' => "Last Name",
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
                    'name' => $value1['rel']
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
		*/


       // $views[] = $view;

        $view = Helpers::rap_with_form($views, $data);


        return [
            'view' => $view,
            'script' => $scripts,
            'message' => Helpers::translate('Connected With Data Fields'),
            'status' => 200,
        ];

    }
	
	 public function unsubscribe_email_post($accountId, $mainData, $data)
    {
        $this->account = Account::find($accountId);
        $this->mainClass = new Mailchimp;
        $this->userId = $this->mainClass->getUserId();
		
        $this->access_token = $this->mainClass->getToken($accountId);
		$api_endpoint = $this->mainClass->getApiEndpoint($accountId);
		
        if (isset($mainData['idAudience'])) {
			$list_id = $mainData['idAudience'][count($mainData['idAudience']) - 1];
			if(is_array($mainData['name'])){
			
				foreach($mainData['name'] as $name){
					$params = [
					   'email_address' => $name,
					   'status' => 'subscribed',
						/*'merge_fields'  => array(
							'FNAME' => $mainData['FNAME'][count($mainData['FNAME']) - 1],
							'LNAME' => $mainData['LNAME'][count($mainData['LNAME']) - 1]
						) 
						*/	
					];
					$this->mainClass->addSubscriberToList($api_endpoint.'/3.0/lists/'.$list_id.'/members/', $this->access_token, $params);
			
				}
			} else {
				$params = [
					   'email_address' => $mainData['name'],
					   'status' => 'unsubscribed',
						/*'merge_fields'  => array(
							'FNAME' => $mainData['FNAME'][count($mainData['FNAME']) - 1],
							'LNAME' => $mainData['LNAME'][count($mainData['LNAME']) - 1]
						) 
						*/	
					];
					$this->mainClass->addSubscriberToList($api_endpoint.'/3.0/lists/'.$list_id.'/members/', $this->access_token, $params);
			}

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
