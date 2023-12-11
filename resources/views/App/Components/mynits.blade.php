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
    padding: 15px 20px;
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

  .justify-content-space-evenly {
    align-items: center;
    justify-content: space-evenly;
  }

  .btn-primary {
    background: #03989E;
    border-radius: 10px;
  }

  .btn-primary:hover {
    color: #000;
    background: #03989E36;
  }

  .nav-pills .nav-link.active,
  .nav-pills .show>.nav-link {
    background: #03989E;
    border-radius: 10px;
    color: #fff;
    text-align: left;
  }

  .nav-pills .nav-link:hover {
    border-radius: 10px;
    text-align: left;
    margin-bottom: 10px;
    color: #000;
    background: #03989E36;

  }

  .nav-pills .nav-link {
    border-radius: 10px;
    text-align: left;
    margin-bottom: 10px;
    color: #000;
    background: #03989E36;

  }

  .iconss {
    display: flex;
    align-items: center;
    justify-content: end;
  }

  .iconss i {
    font-size: 25px;
    color: gray;
  }

  .css-cn7h8k,
  .css-182eym2 {
    font-weight: 500;
  }

  .modal-lg,
  .modal-xl {
    max-width: 620px;
  }

  .border-box {
    border: 1px solid #ebebeb;
    padding: 19px;
    background-color: #fff;
}
</style>


<section id="sidebar_main_wrapper">
  @includeIf('App.Components.Sidebar')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <section id="main">


    <div class="container">
      <div class="border-box">
        <div class="row">
          <div class="col-md-6">
            <h2 class="text-left"><strong>My Zaps</strong></h2>
          </div>
          <div class="col-md-6">
            <div class="row">
              <div class="col-md-7">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-search" aria-hidden="true"></i>
                    </span>
                  </div>
                  <input type="text" class="form-control" name="apps" placeholder="Apps">
                </div>
              </div>
             <!-- <div class="col-md-5">
                <a href="javascript:void(0)" class="btn btn-primary w-100 d-flex justify-content-space-evenly" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa fa-plus" aria-hidden="true"></i> <span>Add connection</span></a>
              </div>-->
            </div>
          </div>
        </div>

        <div class="row mt-3">
          <div class="col-md-4">
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
              <button class="nav-link active" id="v-pills-home-tab text-left" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">All apps</button>
             <!-- <button class="nav-link" id="v-pills-profile-tab text-left" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">Custom integrations</button>-->
            </div>
          </div>
          <div class="col-md-8">
            <div class="tab-content" id="v-pills-tabContent">
              <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                <div class="row">
				<?php if($accounts){?>
				<?php foreach($accounts as $account){?>
                  <div class="col-md-12">
                    <div class="costom-box">
                      <div class="col-1">
                        <div class="img-box">
                          <img src="<?php echo $account->logo;?>" alt="">
                        </div>
                      </div> 
                      <div class="col-5 text-left">
                        <h6><strong><?php echo $account->app_name;?></strong></h6>
                      </div>
                      <div class="col-2">
                        <div class="css-cn7h8k"><span class="css-a33axo-Text--paragraph3Bold--neutral800"><span><?php echo $account->total;?></span></span>
                          <div class="css-muxcbk-Text--smallPrint1--neutral800">Connection</div>
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="css-182eym2"><span class="css-a33axo-Text--paragraph3Bold--neutral800"><span><?php echo $account->zaps;?></span></span>
                          <div class="css-muxcbk-Text--smallPrint1--neutral800">Nits</div>
                        </div>
                      </div>
                      <div class="col-2">
                        <div class="iconss">
                          <a href="{{route('Apps.connection_apps',$account->type)}}"><div class=""><i class="fa fa-angle-right"></i></div></a>
                        </div>
                      </div>
                    </div>
                  </div>
				<?php }} else {?>
				<div class="col-md-12">
				<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSAJ13E0CwQMumAc5S0xAS2bGH5G8QD9b_nuO4LzBLPqmnN2FnORhE3AC_7t-w8"/>
                  </div>
				
				<?php }  ?>
                </div>
              </div>
            
            </div>
          </div>
        </div>
      </div>
    </div>

    
  </section>
</section>