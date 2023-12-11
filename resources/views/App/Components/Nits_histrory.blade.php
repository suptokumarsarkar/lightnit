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
               <!-- <div class="col-md-4">

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
              <button onclick="return Submit('#submit')" class="btn custombtn"> <i class="fa fa-refresh" aria-hidden="true"></i></button>
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
                  <a class="nav-link active" aria-current="page" href="#">Active</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('Apps.nits_list_history')}}">Link</a>
                </li>
              </ul>
            </div>
            <!--<div class="col-md-6">
              <button class="btn btn-outline-primary" type="submit"><i class="fa fa-bell" aria-hidden="true"></i> Error notification settings</button>
            </div>-->
          </div>
        </div>

        <div class="mt-4" >
          <div class="row">
            <div class="col-md-6">
              <div class="costom-box">
                <div class="array">
                  <div class="manbox text-left">
                    <i class="fa fa-bell" aria-hidden="true"></i>
                  </div>
                  <div class="leftbox">
                    <p>Nits that ran </p>
                    <h2><?php echo count($zaps);?></h2>
                  </div>
                </div>
                <div class="info-btn">
                  <i class="fa fa-info-circle" aria-hidden="true"></i>

                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="costom-box">
                <div class="array">
                  <div class="manbox text-left">
                    <i class="fa fa-bell" aria-hidden="true"></i>
                  </div>
                  <div class="leftbox">
                    <p>Tasks automated </p>
                    <h2><?php echo count($zap_records);?></h2>
                  </div>
                </div>
                <div class="info-btn">
                  <i class="fa fa-info-circle" aria-hidden="true"></i>

                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- <table id="customers">
          <tr>
            <th>App</th>
            <th>Event</th>
            <th>Status</th>
            <th>Date</th>
            <th>Action</th>
          </tr> -->

        <!-- <?php if (count($zaps) > 0) { ?>

            <?php

                foreach ($zaps as $zap) {
                  $d = (json_decode($zap->zapData));
                  foreach ($d as $s) {
                    //		echo '<pre>';
                    //		print_r($s);
                  }
            ?>
              <tr>
                <td><?php echo $s->AppId; ?></td>
                <td><?php echo $s->action_id; ?></td>
                <td><?php echo $zap->status; ?></td>
                <td><?php echo $zap->created_at; ?></td>
                <td>
                  <?php if ($zap->status == 'active') { ?>
                    <a href="javascript:" onclick="" class="btn btn-danger"> Inactive</a>
                  <?php } else { ?>
                    <a href="javascript:" onclick="" class="btn btn-primary"> active</a>
                  <?php } ?>
                  </th>

              </tr>
            <?php } ?>
          <?php } else { ?>
            <tr>
              <td colspan="5" style="text-align: center;"> No Records
              </td>
            </tr>
        </table>
      <?php } ?> -->


        <!--       
      </div>
    </div>
    </div>
    <table id="tab"> -->
        <!-- <tr> -->
        <!-- <form>
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-6 col-xl-6 col-lg-6">
                <label for=""><b style="color:blue;">Task Usage</b>
                  <b style="margin-left:20px;">Zap Runs</b></label>
                <hr>
                <input type="text" class="form-control" name="" id="" style="height:130px;text-align:center;" placeholder="Zaps that ran  1" />
              </div><br>
              <div class="col-md-6 col-xl-6 col-lg-6">
                <div class="col-md-5" style="margin-left:180px;">
                  <input type="text" class="form-control" placeholder="Error Notification Settings">
                </div><br>
                <input type="text" class="form-control" name="" id="" style="height:130px;text-align:center;" placeholder="Tasks automated  7" />

              </div>
            </div>
        </form><br> -->
        <div class="">
          <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

          <div class="custom-graph mt-4">
            <canvas id="myChart" style="width:100%;max-width:1000px"></canvas>
          </div>

         <!--<div class="mt-4">
            <div class="row">
              <div class="col-md-6">
                <a href="#">Zap details </a>
              </div>
              <div class="col-md-6">
                <a href="#">Zap details</a>
              </div>
            </div>
          </div>

          <div class="mt-4">
            <div class="row">

              <div class="col-md-12">
                <div class="costom-box">
                  <div class="col-md-2">
                    <div class="img-box">
                      <img src="https://lightnit.com/dashboard/storage/app/public/logo/2022-08-07-62efbbc78544e.png" alt="">
                      <img src="https://lightnit.com/dashboard/storage/app/public/logo/2022-08-07-62efbbc78544e.png" alt="">
                    </div>
                  </div>
                  <div class="col-md-6 text-left">
                    <h6><strong>Untitled Zap</strong></h6>
                    <p><a href="#" class="Off_class">Off</a> <strong>Last ran on • </strong>Jun 26, 2023 02:30 pm</p>
                  </div>
                  <div class="col-md-2">
                    <div class="dots">
                      <span></span> 7
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="icon">
                      <i class="fa fa-power-off" aria-hidden="true"></i>
                      <div class="dot-btn"><i class="fa fa-ellipsis-h"></i></div>
                    </div>
                  </div>
                </div> 
              </div>
            </div>
          </div>

	-->

       

      

          <script>
            var xValues = <?php echo json_encode($date_array);?>;
            var yValues = <?php echo json_encode($date_data_array);?>;
           
            var barColors = ["blue"];

            new Chart("myChart", {
              type: "bar",
              data: {
                labels: xValues,
                datasets: [{
                  backgroundColor: barColors,
                  data: yValues
                }]
              },
              options: {
                legend: {
                  display: false
                },
                title: {
                  display: true,
                  text: "Tasks Past <?php echo count($date_array);?> days"

                }
              }
            });
          </script>
        </div>
        </div>
      </div>
    </div>
  </section>
</section>
<script>
function Submit(a){
		$.ajax({
            url: '{{route('getnits')}}',
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