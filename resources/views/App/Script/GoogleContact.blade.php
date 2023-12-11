<script>
    function getPersonalStatementGoogleContact(data) {
        return "<h6>" + data.name + "</h6><i style='font-size: 12px'>" + data.email + "</i>";
    }

    let yxContact = 0;

    function connectAccountGoogleContact() {
        yxContact = 0;
        regGoogleContact();

    }

    function connectAccountActionGoogleContact() {
        yxContact = 1;
        regGoogleContact();
    }

    function checkTriggerGoogleContact(trigger, accountId, AppId = "GoogleContact") {
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


    function checkActionGoogleContact(trigger, action) {
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
    $settings = new \App\Logic\Settings;
    $googleClientId = $settings->get('googleClientId');
@endphp
<script src="https://accounts.google.com/gsi/client">
</script>
<script>
    function regGoogleContact() {
        /*const clientGoogleContact = google.accounts.oauth2.initCodeClient({
            client_id: '{{$googleClientId}}',
            scope: 'https://www.googleapis.com/auth/userinfo.email \
          https://www.googleapis.com/auth/userinfo.profile\
          https://www.googleapis.com/auth/contacts',
            ux_mode: 'popup',
            callback: (response) => {
                response.type = 'GoogleContact';
                $.ajax({
                    url: '{{route('googleToken')}}',
                    type: 'post',
                    data: response,
                    success: function (data) {
                        data = JSON.parse(data);
                        if (data.status === 200) {
                            displaySuccessToaster(data.message);
                            if (yxContact) {
                                getAccountsAction('GoogleContact');
                            } else {
                                getAccounts('GoogleContact');
                            }
                        } else {
                            displayErrorToaster(data.message);
                        }
                    }
                })
            },
        });
        clientGoogleContact.requestCode();
	*/ 
	
	 var authUrl = 'https://accounts.google.com/o/oauth2/auth?client_id={{$googleClientId}}&redirect_uri=https://lightnit.com/oauth/redirect&scope=profile%20email%20https://www.googleapis.com/auth/userinfo.email%20https://www.googleapis.com/auth/userinfo.profile%20https://www.googleapis.com/auth/contacts&response_type=code&access_type=offline&prompt=consent';

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

                        response.type = 'GoogleContact';
                        $.ajax({
                            url: '{{route('googleToken')}}',
                            type: 'post',
                            data: response,
                            success: function (data) {
                                data = JSON.parse(data);
                                console.log(data);
                                if (data.status === 200) {
                                    displaySuccessToaster(data.message);
                                    if (yxContact) {
                                        getAccountsAction('GoogleContact');
                                    } else {
                                        getAccounts('GoogleContact');
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
