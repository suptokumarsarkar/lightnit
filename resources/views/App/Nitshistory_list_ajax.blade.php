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

			<?php if(count($zaps)>0){?>
				
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
				   <p><a href="#" class="Off_class">On</a> <strong>Last ran on • </strong><?php echo date('M, d, Y H:i',strtotime($zap_records->created_at));?></p>
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
		  

