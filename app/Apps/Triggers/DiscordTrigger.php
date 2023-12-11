<?php

namespace App\Apps\Triggers;

use App\Apps\Discord;
use App\Http\Controllers\Api\Apps\Manager;
use App\Logic\Helpers;
use App\Models\Account;

class DiscordTrigger
{
    private $account;
    /**
     * @var Discord
     */
    private $mainClass;
    /**
     * @var mixed
     */
    private $access_token;

    function __construct($accountId)
    {
        $this->account = Account::find($accountId);
        $this->mainClass = new Discord;
        $this->userId = $this->mainClass->getUserId();
        $this->access_token = $this->mainClass->getToken($accountId);
    }



}
