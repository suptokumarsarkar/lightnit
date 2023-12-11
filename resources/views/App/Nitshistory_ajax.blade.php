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
                    <h2><?php echo ($zap_records);?></h2>
                  </div>
                </div>
                <div class="info-btn">
                  <i class="fa fa-info-circle" aria-hidden="true"></i>

                </div>
              </div>
            </div>
          </div>
        </div>
 


        <div class="">
          <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

          <div class="custom-graph mt-4">
            <canvas id="myChart" style="width:100%;max-width:1000px"></canvas>
          </div>

      

       

      

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
       