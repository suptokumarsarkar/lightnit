<?php

namespace App\Apps\Actions;

use App\Apps\Slack;
use App\Http\Controllers\Api\Apps\Manager;
use App\Logic\Helpers;
use App\Models\Account;

class SlackActionFields
{
    function __construct($accountId = 0)
    {
        $this->mainClass = new Slack();
        if ($accountId != 0) {
            $this->account = Account::find($accountId);
            $this->mainClass = new Slack();
            $this->userId = $this->mainClass->getUserId();
            $this->access_token = $this->mainClass->getToken($accountId);
        }
    }

    
}
