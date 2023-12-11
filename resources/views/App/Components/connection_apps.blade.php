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

       <div class="col-md-2">
			<div class="img-box">
			  <img src="<?php echo $app_data->getLogo();?>" alt="">
			  &nbsp; &nbsp;<h2> <?php echo $app_data->AppId;?></h2>
			</div>
		  </div>

        <div id="result">
        <div class="mt-5">
            <div class="row">
              <div class="col-md-6">
                <ul class="nav nav-tabs custon-pill">
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" >Connections</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link " href="{{ route('Apps.connections_data',$slug)}}">Nits</a>
                  </li>
                </ul>
              </div>
              
            </div>
          </div>

			<?php 
		
			if(count($accounts)>0){?>
				
           <div class="row">
				<?php 
				foreach($accounts as $account){
					$email = (json_decode($account->data)->email);
					$user_id =Auth::id();
					
					?>
              <div class="col-md-12">
                <div class="costom-box mt-2">
              
                  <div class="col-md-6 text-left">
                    <h6><strong><?php echo $account->type;?> <?php echo $email;?></strong></h6>
				   <p><a href="#" class="Off_class"> <?php echo $email;?></a>- <strong>Added• </strong><?php echo date('M, d, Y H:i',strtotime($account->created_at));?></p>
				  </div>
                  <div class="col-md-2">
                    <div class="dots">
                       <?php echo !empty($account->zaps_count)?$account->zaps_count:0;?></br>
					   Nits
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