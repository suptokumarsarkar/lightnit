<style>
  #customers {
    font-family: Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
  }

  #customers td,
  #customers th {
    border: 1px solid #ddd;
    padding: 8px;
  }

  #customers tr:hover {
    background-color: #ddd;
  }

  #customers th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #03989E;
    color: white;
  }

  #tab th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: white;
    color: black;
  }

  #tab {
    font-family: Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
  }

  #tab td,
  #tab th {
    border: 1px solid #ddd;
    padding: 8px;
  }

  #tab tr:hover {
    background-color: #ddd;
  }

  .input-group-text {
    height: 40px;
    background: #fffdf9;
    border-right: 0;
  }

  .form-control {
    border-left: 0;
    height: 40px;
    background-color: #fffdf9;
  }

  .text-left {
    text-align: left;

  }

  .custombtn {
    height: 40px;
    background-color: #fffdf9;
    width: 50px;
    border: 1px solid #c9c9c9;
  }

  .select-btn {
    width: -webkit-fill-available;
  }

  .select-btn .input-group-text {
    border-radius: 20px 0px 0px 20px;
    background-color: #e9ecef;
  }

  .select-btn .form-control {
    border-radius: 0px 20px 20px 0px;
  }

  .clear-btn {
    display: flex;
    align-items: center;
    width: 80px;
    margin-left: 10px;
  }

  .custon-pill {
    border: none;
  }

  .custon-pill .nav-link {
    border-top: 0;
    border-left: 0;
    border-right: 0;
    border-bottom: 2px solid #c9c9c9;
    color: #707070;
    font-weight: 900;
  }

  .custon-pill .nav-link.active {
    border-top: 0;
    border-left: 0;
    border-right: 0;
    border-bottom: 2px solid #3d4592;
    color: #3d4592;
    font-weight: 900;
  }

  .array {
    display: flex;
    align-items: center;
    text-align: left;
  }

  .costom-box {
    display: flex;
    justify-content: space-between;
    border: 1px solid gray;
    border-radius: 10px;
    padding: 20px;
    align-items: center;
    margin-bottom: 15px;
  }

  .leftbox {
    margin-left: 15px;
  }

  .custom-graph {
    padding: 15px;
    border: 1px solid gray;
    border-radius: 10px;
  }

  .Off_class {
    font-weight: 800;
    color: white;
    background-color: #424242;
    padding: 1px 10px;
    border-radius: 15px;
  }

  .img-box {
    display: flex;
  }

  .img-box img {
    width: 45px;
    padding: 5px;
    border: 1px solid gray;
    margin: 0px 5px;
    border-radius: 5px;
  }

  .icon {
    display: flex;
    align-items: center;
    justify-content: space-around;
  }

  .icon .fa-power-off {
    padding: 10px;
    background-color: #00afaf;
    border-radius: 42px;
    color: white;
  }

  .dot-btn {
    margin-left: 15px;
    padding: 10px 20px;
    background-color: gainsboro;
    border-radius: 5px;
  }

  .dots span {
    width: 5px;
    height: 5px;
    background: #029f9f;
    padding: 0px 10px;
    border-radius: 50px;
  }

  .checkbox-section .form-check-input {
    padding: 10px;
  }

  .success-box i {
    height: 35px;
    width: 35px;
    margin: 3px 10px;
    border-radius: 25px;
    font-size: 22px;
    padding: 7px;
    color: white;
    /* align-items: center; */
    background-color: #0f9f0d;
  }

  .checkbox-section {
    display: flex;
    align-items: center;
  }

  @media only screen and (max-width: 600px) {
    .costom-box {
      display: block;

    }

    ul.nav.nav-tabs.custon-pill {
      margin-bottom: 15px;
    }

    .input-group {
      margin-bottom: 15px;
    }

    .costomConmtainer {
      width: 315px;
      background-color: #fff;
    }
  }
  .costomConmtainer {
      background-color: #fff;
    }
  .border-box {
    border: 1px solid #ebebeb;
    padding: 19px;
}
</style>


<section id="sidebar_main_wrapper">
  @includeIf('App.Components.Sidebar')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <section id="main">

    <div class="container costomConmtainer">
      <div class="border-box">

        <h2 class="text-left"><strong>Nits history</strong></h2>
         <form class="mt-3" method="post" id="submit">
		    @csrf
          <div class="row  mb-4">

            <div class="col-md-11">
              <div class="row">
                <div class="col-md-4">

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="basic-addon1"><i class="fa fa-calendar" aria-hidden="true"></i>
                      </span>
                    </div>
                    <input type="text" class="form-control" placeholder="daterange" aria-label="Username" id="daterange" value="" name="daterange" placeholder="Date range">
                  </div>
                </div>
                <!--<div class="col-md-4">

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="basic-addon1"><svg width="30" height="30" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M11 12H7.74996L13 5.75V12H16.25L11 18.25V16H8.99996V23.75L20.54 10H15V0.25L3.45996 14H11V12Z" fill="#2D2E2E"></path>
            </svg>
                      </span>
                    </div>
                    <input type="text" class="form-control" name="zaps" placeholder="Zaps">
                  </div>
                </div>-->
                <div class="col-md-4">

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="basic-addon1"><i class="fa fa-search" aria-hidden="true"></i>
                      </span>
                    </div>
                    <input type="text" class="form-control"  id="connect_1"  onkeyup="cht1()"  name="apps" placeholder="Apps">
                  </div>
                </div>
				<div class="col-md-1">
              <button  onclick="return Submit('#submit')" class="btn custombtn"> <i class="fa fa-refresh" aria-hidden="true"></i></button>
            </div>
              </div>
            </div>
            
          </div>
        </form>

       
        <div id="result">
        <div class="mt-5">
            <div class="row">
              <div class="col-md-6">
                <ul class="nav nav-tabs custon-pill">
                  <li class="nav-item">
                    <a class="nav-link " aria-current="page" href="{{ route('Apps.nitshistory')}}">Active</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active" href="#">Link</a>
                  </li>
                </ul>
              </div>
              
            </div>
          </div>

			<?php 
		
			if(count($zaps)>0){?>
				
          <div class="mt-4">
            <div class="row">
				<?php 
				foreach($zaps as $zap){
					$user_id =Auth::id();
					$id= $zap->id;
					$first_Id = (json_decode($zap->zapData)->trigger->AppId);
					$second_Id =  (json_decode($zap->zapData)->action->AppId);
					
					$app_data = App\Models\AppsData::where('AppId', $first_Id)->first();
					$logo = $app_data->getLogo();
					
					$app_data2 = App\Models\AppsData::where('AppId', $second_Id)->first();
					$logo2 = $app_data2->getLogo();
					
					$zaps_count =DB::select("select count(id) as total from `zap_records` where `zapId` = '$id' and  `userId` = $user_id");
					//$zaps =DB::select("select count(id) as total from `zap_records` where `zapId` = '$id' and  `userId` = $user_id");
					$zap_records = App\Models\ZapRecord::where('zapId', $id)->orderBy('created_at', 'desc')->first();
					if($zaps_count[0]->total>0){
      
					?>
              <div class="col-md-12">
                <div class="costom-box mt-2">
                  <div class="col-md-2">
                    <div class="checkbox-section">
                      <!--<div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                      </div>-->

                      <div class="success-box">
                        <i class="fa fa-check-square-o" aria-hidden="true"></i> <span><strong>Success</strong></span>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="img-box">
                      <img src="<?php echo $logo;?>" alt="">
                      <img src="<?php echo $logo2;?>" alt="">
                    </div>
                  </div>
                  <div class="col-md-4 text-left">
                    <h6><strong>Untitled Nit</strong></h6>
					<?php if(!empty($zap_records)) {?>	
				   <p><a href="#" class="Off_class"><?php echo $zap->status;?></a> <strong>Last ran on • </strong><?php echo date('M, d, Y H:i',strtotime($zap_records->updated_at));?></p>
					<?php }?>
				  </div>
                  <div class="col-md-2">
                    <div class="dots">
                      <span></span> <?php echo !empty($zaps_count)?$zaps_count[0]->total:0;?>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="icon">
                      <i class="fa fa-user 2x" aria-hidden="true"></i>
                    </div>
                  </div>
                </div>
              </div>
				<?php }?>
				<?php }?>


            </div>
          </div>
			<?php } else {?>
			<div class="col-md-12">
			<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSAJ13E0CwQMumAc5S0xAS2bGH5G8QD9b_nuO4LzBLPqmnN2FnORhE3AC_7t-w8"/>
			  </div>
			
			<?php }?>
		  


      

        </div>
        </div>
      </div>
    </div>
  </section>
</section>
<script>

function Submit(a){
		$.ajax({
            url: '{{route('getnits_ajax')}}',
			data: $(a).serialize(),
			type: "POST",
            success: function (data) {
				console.log(data);
            	$('#result').html(data);
            }
        });
	
	return false;
}

  $.ajax({
            url: '{{route('getApps')}}',
            data: 'json=true',
            success: function (data) {
                data = JSON.parse(data);
                autocomplete(document.getElementById("connect_1"), data, 'action_checkup');
            }
        });
		
		 function cht1() {
            hook1 = null;
            console.log(hook1);
        }
		
		
  $('#daterange').daterangepicker();
  $('#daterange').on('apply.daterangepicker', function(ev, picker) {
    console.log(picker.startDate.format('YYYY-MM-DD'));
    console.log(picker.endDate.format('YYYY-MM-DD'));
  });
</script>