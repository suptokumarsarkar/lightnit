<script>
    function getPersonalStatementGmail(data) {
        return "<h6>" + data.name + "</h6><i style='font-size: 12px'>" + data.email + "</i>";
    }

    let yxGmail = 0;

    function connectAccountGmail() {
        yxGmail = 0;
        regGmail();
    }

    function connectAccountActionGmail() {
        yxGmail = 1;
        regGmail();
    }

    function checkTriggerGmail(trigger, accountId, AppId = "Gmail") {
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


    function checkActionGmail(trigger, action) {
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


	 function checkActionFilterGmail(trigger, accountId,AppId,conditions) {
		$.ajax({
            url: '{{route('checkTrigger')}}',
            type: 'POST',
            data: 'trigger=' + trigger + "&accountId=" + accountId + "&AppId=" + AppId+"&conditions=" + conditions,
            beforeSend: function () {
                $(".moni_rh_567_summary_disbled_btn_filter").html('{{\App\Logic\translate('Checking Trigger...')}}');
            },
            success: function (data) {
                $(".moni_rh_567_summary_disbled_btn_filter").html('{{\App\Logic\translate('Check Action')}}');
               
                if (data.status === 200) {
					 console.log(data);
                    displaySuccessToaster(data.message);
                     $(".filterBlock").attr("open", true);
                    $(".filterBlock").show("slow");  
                    $(".app_filter_comment").html(data.data.view.view);
                    $(".app_filter_comment").html(data.data.script);
                    scroll_to_id('.filterBlock', 20)
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

</script>
@php
    $settings = new \App\Logic\Settings;
    $googleClientId = $settings->get('googleClientId');

@endphp

<script>
    
    function regGmail() {
        var authUrl = 'https://accounts.google.com/o/oauth2/auth?client_id={{$googleClientId}}&redirect_uri=https://lightnit.com/oauth/redirect&scope=profile%20email%20https://www.googleapis.com/auth/userinfo.email%20https://www.googleapis.com/auth/userinfo.profile%20https://www.googleapis.com/auth/gmail.modify%20https://www.googleapis.com/auth/gmail.labels%20https://www.googleapis.com/auth/gmail.compose%20https://www.googleapis.com/auth/gmail.send%20https://www.googleapis.com/auth/gmail.insert%20https://www.googleapis.com/auth/gmail.readonly&response_type=code&access_type=offline&prompt=consent';
console.log(authUrl);

        // Open the Google OAuth popup window
        var authWindow = window.open(authUrl, '_blank', 'width=500,height=600');

        // Set an interval to check if the window has been closed or redirected
        var intervalId = setInterval(function () {
            if (authWindow.closed) {
                // Popup window closed without redirection
                clearInterval(intervalId);
                console.log('Authentication canceled or failed.');
            } else {
                try {
                    var redirectedUrl = authWindow.location.href;

                    // Check if the redirected URL contains the code and other parameters in the query string
                    if (redirectedUrl.includes('?code=')) {
                        clearInterval(intervalId);

                        // Extract the query string from the redirected URL
                        var queryString = redirectedUrl.split('?')[1];

                        // Convert the query string to a JavaScript object
                        var redirectData = {};
                        var params = new URLSearchParams(queryString);
                        params.forEach(function (value, key) {
                            redirectData[key] = value;
                        });

                        // Close the authentication window
                        authWindow.close();

                        // Log the redirect data
                        let response = redirectData;

                        response.type = 'Gmail';
                        $.ajax({
                            url: '{{route('googleToken')}}',
                            type: 'post',
                            data: response,
                            success: function (data) {
                                data = JSON.parse(data);
                                console.log(data);
                                if (data.status === 200) {
                                    displaySuccessToaster(data.message);
                                    if (yxGmail) {
                                        getAccountsAction('Gmail');
                                    } else {
                                        getAccounts('Gmail');
                                    }
                                } else {
                                    displayErrorToaster(data.message);
                                }
                            }
                        })
                    }
                } catch (error) {
                    // Ignore any cross-origin errors
                }
            }
        }, 500);
    }


</script>
