<section id="dropdown">
    <div class="moni_container">
        <div class="moni_rh_567_dropdown_wrapper">
            <details class="moni_rh_567_dropdown_details myFilter" style="display: none;">
                <summary class="moni_rh_567_dropdown_summary">
                    <div class="moni_rh_567_dropdown_summary_apps_icon_wrapper">
                        <span class="moni_rh_567_img">
                            <img class="AppTriggerLogo"
                                 style="height: 40px; width: 40px; border-radius: 0; object-fit: contain;"
                                 src="{{$first->getLogo()}}" alt="{{$first->app->AppName}}">
                        </span>
                        <div class="moni_rh_567_dropdown_summary_apps_icon_tag_content">
                            <div class="moni_rh_567_dropdown_summary_apps_icon_tag_content_heading_wrapper">
                                <span class="moni_rh_567_dropdown_summary_apps_icon_tag_content_svg_icon_tag">
                                   {{\App\Logic\translate('Filter')}}
                                </span>
                            </div>
                            <div
                                class="moni_rh_567_dropdown_summary_apps_icon_tag_content_svg_icon_tag_title">
                                <h2 class="AppFilterName">{{\App\Logic\translate('Filter')}}</h2>
                                <h6 class="AppFilterDescription">{{\App\Logic\translate('Only continue if...')}}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="moni_rh_567_right_content">
                        <span class="moni_rh_567_right_content_svg_icon_wrapper balmiki">
                            <svg width="35" height="35" viewBox="0 0 24 24" fill="none"
                                 xmlns="http://www.w3.org/2000/svg"><path
                                    d="M12 22C13.9778 22 15.9112 21.4135 17.5557 20.3147C19.2002 19.2159 20.4819 17.6541 21.2388 15.8268C21.9957 13.9996 22.1937 11.9889 21.8079 10.0491C21.422 8.10929 20.4696 6.32746 19.0711 4.92894C17.6725 3.53041 15.8907 2.578 13.9509 2.19215C12.0111 1.8063 10.0004 2.00433 8.17316 2.76121C6.3459 3.51809 4.78412 4.79981 3.6853 6.4443C2.58649 8.08879 2 10.0222 2 12C2 14.6522 3.05357 17.1957 4.92893 19.0711C6.8043 20.9464 9.34784 22 12 22ZM8.21 10.79L11 13.59L16.29 8.29L17.71 9.71L11 16.41L6.79 12.21L8.21 10.79Z"
                                    fill="#0F884E"></path></svg>
                            <svg width="35" height="35" viewBox="0 0 24 24" fill="none"
                                 xmlns="http://www.w3.org/2000/svg"><path
                                    d="M12 22C17.51 22 22 17.51 22 12C22 6.49 17.51 2 12 2C6.49 2 2 6.49 2 12C2 17.51 6.49 22 12 22ZM11 7H13V13H11V7ZM12 14.75C12.69 14.75 13.25 15.31 13.25 16C13.25 16.69 12.69 17.25 12 17.25C11.31 17.25 10.75 16.69 10.75 16C10.75 15.31 11.31 14.75 12 14.75Z"
                                    fill="#DFB900"></path></svg>
                        </span>
                    </div>
                </summary>
	
                <details class="moni_rh_567_dropdown_details_inner_details" open="">
                   

                    <div class="moni_rh_567_summary_content_wrapper">
                     <label for="triggers">{{\App\Logic\translate('Only continue if…')}}<p>
                                    ({{\App\Logic\translate('Required')}})</p></label>
                        <div class="moni_rh_567_summary_content_secend_row_wrapper row">
                            <div class="col-md-4">
                            <select name="filters" id="filters" class="form-control filters"
                                   >
                                <option value="CONTAINS">(Text) Contains</option>
								<option value="DOES_NOT_CONTAINS">(Text) Does not Contains</option>
								<option value="EXACTLY_MATCH">(Text) Exactly matches</option>
								<option value="EXACTLY_NOT_MATCH">(Text) Does not exactly match</option>
								<option value="IS_IN">(Text) Is in</option>
								<option value="IS_NOT_IN">(Text) Is not in</option>
								<option value="START_WITH">(Text) Starts with</option>
								<option value="DOES_NOT_START_WITH">(Text) Does not start with</option>
								<option value="END_WITH">(Text) End with</option>
								<option value="GREATER_THAN">(Number) Greater than</option>
								<option value="LESS_THAN">(Number) Less than</option>

                            </select>
							</div>
							 <div class="col-md-4">
								<input type="text" name="filter_keyword" class="form-control filter_keyword"/>
							</div>
							 <div class="col-md-4">
							 <a class="btn btn-danger" fdprocessedid="s1m5kq">
							 <i class="fa fa-plus" aria-hidden="true"></i>
							 
							 <span class="css-x1jslp-BaseButton__buttonText">And</span>
							 </a>
							 
							  <a class="btn btn-danger" fdprocessedid="s1m5kq">
							 <i class="fa fa-plus" aria-hidden="true"></i>
							 
							 <span class="css-x1jslp-BaseButton__buttonText">OR</span>
							 </a>
							 </div>
							
                        </div>
						</br>
                       
                        <div class="moni_rh_567_summary_btn_wrapper">
                            <button class="moni_rh_567_summary_btn filter_enable_now"
                                   >{{\App\Logic\translate('Continue')}}</button>
                        </div>
                    </div>

                </details>
			
                <details class="moni_rh_567_dropdown_details_inner_details filterBlock"  style="display: none;">
                    <summary class="moni_rh_567_dropdown_summary_inner_summary">
                        <h3 class="moni_rh_567_dropdown_summary_inner_summary_heading"><i
                                class="fa-solid fa-angle-down"></i>{{\App\Logic\translate('App Filter')}}</h3>
                        <span class="moni_rh_567_dropdown_summary_inner_summary_heading_svg_icon balmiki">
                            <svg width="35" height="35" viewBox="0 0 24 24" fill="none"
                                 xmlns="http://www.w3.org/2000/svg"><path
                                    d="M12 22C13.9778 22 15.9112 21.4135 17.5557 20.3147C19.2002 19.2159 20.4819 17.6541 21.2388 15.8268C21.9957 13.9996 22.1937 11.9889 21.8079 10.0491C21.422 8.10929 20.4696 6.32746 19.0711 4.92894C17.6725 3.53041 15.8907 2.578 13.9509 2.19215C12.0111 1.8063 10.0004 2.00433 8.17316 2.76121C6.3459 3.51809 4.78412 4.79981 3.6853 6.4443C2.58649 8.08879 2 10.0222 2 12C2 14.6522 3.05357 17.1957 4.92893 19.0711C6.8043 20.9464 9.34784 22 12 22ZM8.21 10.79L11 13.59L16.29 8.29L17.71 9.71L11 16.41L6.79 12.21L8.21 10.79Z"
                                    fill="#0F884E"></path></svg>
                            <svg width="35" height="35" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 22C17.51 22 22 17.51 22 12C22 6.49 17.51 2 12 2C6.49 2 2 6.49 2 12C2 17.51 6.49 22 12 22ZM11 7H13V13H11V7ZM12 14.75C12.69 14.75 13.25 15.31 13.25 16C13.25 16.69 12.69 17.25 12 17.25C11.31 17.25 10.75 16.69 10.75 16C10.75 15.31 11.31 14.75 12 14.75Z" fill="#DFB900"></path></svg>
                        </span>
                    </summary>

                    <div class="moni_rh_567_summary_content_wrapper">
                        <div class="moni_rh_567_summary_content_secend_row_wrapper app_filter_comment">

                        </div>
                        <div class="moni_rh_567_summary_btn_wrapper">
                            <button class="moni_rh_567_summary_disbled_btn_filter" onclick="goActionPage2()">{{\App\Logic\translate('Check Action')}}</button>
                        </div>
                    </div>

                </details>


            </details>
        </div>
<input type="hidden" id="conditions" />
    </div>
</section>
@push('MasterScript')

    <script>
    
     

        function goActionPage2() {
            $(".myFilter").attr("open", false);
            $(".mySelfAction").slideDown();
            scroll_to_id(".mySelfAction",20);
            $(".mySelfAction").attr("open", true);
        }

       
       


        function goNext2() {
            $('#trigger_next').slideDown();
            document.getElementById('trigger_next').open = true;
            scroll_to_id('#trigger_next', 20)
        }
		$(document).ready(function () {
            $(".filter_enable_now").click(function(){
				var conditions = [];
				$('.filters').each(function(index, element) {
				  var value = $(element).val();
				  console.log($('.filter_keyword').eq(index).val());
				  console.log($(element).val());
				 var data =  { 'con': $(element).val(), 'keyword': $('.filter_keyword').eq(index).val(),'condition': 'And'};
				  conditions.push(data);
				 // conditions.push($(element).val());
				}); 
				console.log(conditions);
				 var serializedArray = JSON.stringify(conditions);
				$('#conditions').val(serializedArray);
				
                let actionData = $("#AppIdRgx").val();
                let filter_keyword = $(".filter_keyword").val();
                window['checkActionFilter' + actionData]($("#triggers").val(),$("#apiAccountId").val(),actionData,$('#conditions').val());
            });
        });
     

      
     
    </script>
@endpush
