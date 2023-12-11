<script>
    function getPersonalStatementMailchimp(data) {
        return "<h6>" + data.accountname + "</h6><i style='font-size: 12px'>" + data.login.email + "</i>";
    }

    let yxMailchimp = 0;

    function connectAccountMailchimp() {
        yxMailchimp = 0;
        regMailchimp();

    }

    function connectAccountActionMailchimp() {
        yxMailchimp = 1;
        regMailchimp();
    }

    function checkTriggerMailchimp(trigger, accountId, AppId = "Mailchimp") {
        $.ajax({
            url: '{{route('checkTrigger')}}',
            type: 'POST',
            data: 'trigger=' + trigger + "&accountId=" + accountId + "&AppId=" + AppId,
            beforeSend: function () {
                $(".moni_rh_567_summary_disbled_btn").html('{{\App\Logic\translate('Checking Trigger...')}}');
            },
            success: function (data) {
                $(".moni_rh_567_summary_disbled_btn").html('{{\App\Logic\translate('Rerun Trigger')}}');
                console.log(data);
                if (data.status === 200) {
                    displaySuccessToaster(data.message);
                    $(".triggerBlock").attr("open", true);
                    $(".triggerBlock").slideDown("slow");
                    $(".app_trigger_comment").html(data.data.view.view);
                    $(".app_trigger_comment").append(data.data.view.script);
                    scroll_to_id('.triggerBlock', 20)
                } else {
                    displayErrorToaster(data.message);
                }
            },
            error: function () {
                $(".moni_rh_567_summary_disbled_btn").html('{{\App\Logic\translate('Rerun Trigger')}}');
                displayErrorToaster('{{\App\Logic\translate('Something went wrong')}}');
            }
        });
    }


    function checkActionMailchimp(trigger, action) {
        let data = {
            trigger: trigger,
            action: action
        }
        $.ajax({
            url: '{{route('getActionForm')}}',
            type: 'POST',
            data: $.param(data),
            beforeSend: function () {
                $(".enable_now_action").html('{{\App\Logic\translate('Creating Action Manager...')}}');
            },
            success: function (data) {
                $(".enable_now_action").html('{{\App\Logic\translate('Change Action Manager')}}');
                if (data.status === 200) {
                    displaySuccessToaster(data.message);
                    $(".actionBlock").attr("open", true);
                    $(".actionBlock").show("slow");
                    $(".app_action_comment").html(data.view);
                    $(".app_action_comment_script").html(data.script);
                    scroll_to_id('.actionBlock', 20)
                } else {
                    displayErrorToaster(data.message);
                }
            },
            error: function () {
                $(".enable_now_action").html('{{\App\Logic\translate('Run Action Manager')}}');
                displayErrorToaster('{{\App\Logic\translate('Something went wrong')}}');
            }
        });
    }


</script>
@php
    $settings = new \App\Apps\Mailchimp;
    $googleClientId = $settings->client_id;
@endphp

<script>

    let authWindow;


    function createOauthWindow(width = 500, height = 600) {

        const clientId = '{{$googleClientId}}';
		
        const redirectUri = 'https%3A%2F%2Flightnit.com%2Fdemo%2Fview%2Foauth%2FMailchimp';
        const responseType = 'code';
        
        const url = `https://login.mailchimp.com/oauth2/authorize?client_id=${clientId}&redirect_uri=${redirectUri}&response_type=${responseType}`;

        const left = (screen.width / 2) - (width / 2);
        const top = (screen.height / 2) - (height / 2);
        const options = `directories=no, titlebar=no, toolbar=no, location=no, status=no, menubar=no, scrollbars=no, resizable=no,
         copyhistory=no, width=${width},height=${height},left=${left},top=${top}`;

        authWindow = window.open(url, 'popup', options);

        const checkPopup = setInterval(() => {
			console.log(authWindow.window.location.href);
            if (authWindow.window.location.href
                .match(decodeURIComponent(redirectUri))) {
                let data = JSON.parse(authWindow.document.getElementById('token').value);
                authWindow.close();
				 let response = {
                    'AppId': 'Mailchimp',
                    'token': data.data,
                };
                $.ajax({
                    url: '{{route('AddApp')}}',
                    type: 'post',
                    data: response,
                    success: function (data) {
                        data = JSON.parse(data);
                        if (data.status === 200) {
                            displaySuccessToaster(data.message);
                            if (yxMailchimp) {
                                getAccountsAction('Mailchimp');
                            } else {
                                getAccounts('Mailchimp');
                            }
                        } else {
                            displayErrorToaster(data.message);
                        }
                    }
                })



            }
            if (!authWindow || !authWindow.closed) return;
            clearInterval(checkPopup);
        }, 1000);


    }

    function regMailchimp() {
        createOauthWindow();
    }

</script>
