@extends('App.Index')
@section('title', 'LightNit App')
@section('description', "This is an automation Project")

@push('headerScript')
    <link rel="stylesheet" href="{{asset('public/css/bootstrap.min.css')}}">
    <!--======= Font Asesome cdn Link =======-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
          integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
          

    <link rel="stylesheet" href="{{asset('public/css/app/style.css' . App\Logic\Helpers::production("version"))}}">
    <link rel="stylesheet" href="{{asset('public/css/app/responsive.css' . App\Logic\Helpers::production("version"))}}">
	
	
	<link rel="stylesheet" href="{{asset('public/css/pricing_style.css' . App\Logic\Helpers::production("version"))}}">
    <link rel="stylesheet" href="{{asset('public/css/pricing_responsive.css' . App\Logic\Helpers::production("version"))}}">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<style>


*{
	padding: 0;
	margin: 0;
}

.btn{
	background-color: #3d4592;
	display: inline-block;
	overflow: hidden;
	font-size: 16px;
	font-family: 'Inter',sans-serif;
	font-weight: 600;
	width: 220px;
	height: 50px;
	content: center;
	}
.btn hover{
	background-color: #2b2358;
	}
	
.btn1{
	padding: 50px 0px;
	}
	
.svg{
	margin-top: 40px;
	margin-bottom: 40px;
	}
	
.font1{
	font-size: 16px;
	color: #2d2e2e;
	font-family: 'Inter',sans-serif;
	font-weight: 700;
	}
	
.font2{
	font-size: 14px;
	color: #2d2e2e;
	font-family: 'Inter',sans-serif;
	font-weight: 400;
	}
	
.card1{
	padding: 30px;
	margin-left: 0px;
	margin-right: 20px;
	}
	
.card2{
	padding: 30px;
	margin-left: 20px;
	margin-right: 0px;
	}
	
.font3{
	font-size: 14px;
	color: #403f3e;
	font-family: 'Inter',sans-serif;
	font-weight: 600;
	}
	
.list1{
	height: 40px;
	width: 40px;
	list-style-type: none;
	}
	
.list2{
	list-style-type: none;
	display: flex;
	margin-left: -100px;
	}
	
.font4{
	font-size: 16px;
	color: #403f3e!important;
	font-family: 'Inter',sans-serif;
	font-weight: 600;
	padding: 20px 10px;
	}
	
.f4{
	font-size: 16px;
	color: #403f3e!important;
	font-family: 'Inter',sans-serif;
	font-weight: 600;
	margin-left: 250px;
	}
	
.div1{
	padding: 50px 0px;
	}

.div2{
	padding: 50px 0px;
	}
	
.div3{
	padding: 50px 0px 0px 150px;
	}

.list3{
	list-style-type: none;
	display: flex;
	}

.font6{
	font-size: 26px;
	color: #666666;
	font-family: 'Degular',sans-serif;
	font-weight: 600;
	}
	
.font7{
	font-size: 16px;
	color: #666666;
	font-family: 'Inter',sans-serif;
	font-weight: 400;
	}
	
.img{
	margin: 0px 0px 0px 0px;
	}
	
.div4{
	padding: 0px 180px;
	}
	
.font8{
	font-size: 24px;
	color: #454646;
	font-family: 'Inter',sans-serif;
	font-weight: 700;
    line-height: 30px;
	}
	
.font9{
	font-size: 16px;
	color: #454646;
	font-family: 'Inter',sans-serif;
	font-weight: 400;
    line-height: 24px;
	}
	
.font10{
	font-size: 14px;
	color: #646362;
	font-family: 'Inter',sans-serif;
	font-weight: 600;
    line-height: 20px;
	margin-top: 15px;
	}
	
.font11{
	font-size: 16px;
	color: #646362;
	font-family: 'Inter',sans-serif;
	font-weight: 400;
    line-height: 24px;
	}
	</style>
@endpush
@section("content")
    {!! App\Logic\Notification::get('top')  !!}

    {{--Include Header--}}
    @includeIf('App.Components.Warning')

    {{--Include Header--}}
    @includeIf('App.Components.Header')
<section id="sidebar_main_wrapper">
  @includeIf('App.Components.Sidebar')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <section id="main">

    <div class="container costomConmtainer">
      <div class="border-box">
	<div class="row div1">
		<h1 class="text-center">Create your first transfer</h1>
    </div>

	<div  class="row div4">
		
		<div class="col-4 img">
			<div class="row svg">
				<svg fill="none" height="125" viewBox="0 0 270 125" width="270" xmlns="http://www.w3.org/2000/svg" class="css-122dq30"><rect fill="#FFFDF9" height="106" rx="12.5" stroke="#2D2E2E" width="106" x="9.5" y="9.5"></rect><rect fill="#FF4F00" height="60" rx="5" width="60" x="33" y="32"></rect><circle cx="63" cy="62" fill="#FFFDF9" r="15"></circle><rect fill="#FFFDF9" height="106" rx="12.5" stroke="#2D2E2E" width="106" x="154.5" y="9.5"></rect><rect fill="#C1B7FF" height="60" rx="5" width="60" x="178" y="32"></rect><path d="M207.5 47L222.655 73.25H192.345L207.5 47Z" fill="#FFFDF9"></path><path d="M115 62L155 62" stroke="#2D2E2E"></path></svg>
			</div>
			<div class="row font6">
				<p class="text-center">1. Connect your apps</p>
			</div>
			<div class="row font7">
				<p class="text-center">Connect your data source and<br> destination apps</p>
			</div>
		</div>
		<div class="col-4 img">
			<div class="row svg">
				<svg fill="none" height="125" viewBox="0 0 159 125" width="159" xmlns="http://www.w3.org/2000/svg" class="css-1noyo2b"><mask height="105" id="mask0_2906_80819" maskUnits="userSpaceOnUse" width="139" x="10" y="10" style="mask-type: alpha;"><rect fill="#0D71F3" height="105" rx="8.75" width="138.25" x="10.375" y="10"></rect></mask><g mask="url(#mask0_2906_80819)"><rect fill="#FFF3E6" height="105" width="138.25" x="10.375" y="10"></rect><path d="M163.23 26V25.5H162.73H65.7305C58.8269 25.5 53.2305 31.0964 53.2305 38V116V116.5H53.7305H152.285C158.33 116.5 163.23 111.599 163.23 105.554V26Z" fill="#FFFDF9" stroke="#2D2E2E"></path><rect fill="#D7D5D2" height="5.51597" rx="2.75799" width="40.4505" x="65.375" y="60.3711"></rect><rect fill="#FF4F00" height="15" rx="1" width="15" x="66.0547" y="37"></rect><circle cx="73.5547" cy="44.5" fill="#FFFDF9" r="3.75"></circle><rect fill="#D7D5D2" height="5.51597" rx="2.75799" width="20.2252" x="113.18" y="60.373"></rect><rect fill="#D7D5D2" height="5.51597" rx="2.75799" width="40.4505" x="65.375" y="71.4043"></rect><rect fill="#D7D5D2" height="5.51597" rx="2.75799" width="20.2252" x="113.18" y="71.4043"></rect><rect fill="#D7D5D2" height="5.51597" rx="2.75799" width="40.4505" x="65.375" y="82.4355"></rect><rect fill="#D7D5D2" height="5.51597" rx="2.75799" width="20.2252" x="113.18" y="82.4355"></rect><rect fill="#3D4592" height="6.80669" rx="1.09307" width="31.3108" x="87.7305" y="95"></rect></g><rect height="104.125" rx="11.5625" stroke="black" stroke-width="0.875" width="137.375" x="10.8125" y="10.4375"></rect></svg>
			</div>
			<div class="row font6">
				<p class="text-center">2. Select data to move</p>
			</div>
			<div class="row font7">
				<p class="text-center">Filter and select which data to send</p>
			</div>
		</div>
		<div class="col-4 img">
			<div class="row svg">
				<svg fill="none" height="125" viewBox="0 0 323 145" width="323" xmlns="http://www.w3.org/2000/svg" class="css-1xt5g7b"><rect fill="#FFFDF9" height="106" rx="12.5" stroke="#2D2E2E" width="106" x="19.5" y="19.5"></rect><rect fill="#FF4F00" height="60" rx="5" width="60" x="43" y="42"></rect><circle cx="73" cy="72" fill="#FFFDF9" r="15"></circle><rect fill="#FFFDF9" height="106" rx="12.5" stroke="#2D2E2E" width="106" x="195.5" y="19.5"></rect><rect fill="#C1B7FF" height="60" rx="5" width="60" x="219" y="42"></rect><path d="M248.5 57L263.655 83.25H233.345L248.5 57Z" fill="#FFFDF9"></path><path d="M177.665 72.3536C177.861 72.1583 177.861 71.8417 177.665 71.6464L174.483 68.4645C174.288 68.2692 173.971 68.2692 173.776 68.4645C173.581 68.6597 173.581 68.9763 173.776 69.1716L176.605 72L173.776 74.8284C173.581 75.0237 173.581 75.3403 173.776 75.5355C173.971 75.7308 174.288 75.7308 174.483 75.5355L177.665 72.3536ZM125 72.5L177.312 72.5L177.312 71.5L125 71.5L125 72.5Z" fill="#2D2E2E"></path><rect fill="#FFF3E6" height="33" rx="16.5" width="44" x="278.5" y="1.5"></rect><g clip-path="url(#clip0_2921_80417)"><path d="M297.376 30.1452L309.397 15.8223H303.626V5.66602L291.605 19.9889H297.376V30.1452Z" fill="#FF4F00"></path></g><rect height="33" rx="16.5" stroke="#2D2E2E" width="44" x="278.5" y="1.5"></rect><defs><clipPath id="clip0_2921_80417"><rect fill="white" height="25" transform="translate(288 5.5)" width="25"></rect></clipPath></defs></svg>
			</div>
			<div class="row font6">
				<p class="text-center">3. Transfer your data</p>
			</div>
			<div class="row font7">
				<p class="text-center">Send your data from one app to<br> another</p>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="row justify-content-center btn1">
			<button class="btn text-white shadow">Create a new transfer</button>
	</div>
	</div>
	
 </div>
    </div>
  </section>
</section>
    {!! App\Logic\Notification::get('bottom')  !!}

@endsection



@push('footerScript')
    <script src="{{asset('public/js/jquery-1.12.4.min.js')}}"></script>
    <script src="{{asset('public/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('public/js/slick.min.js')}}"></script>
    <script src="{{asset('public/js/script.js'. App\Logic\Helpers::production("version"))}}"></script>
    <script src="{{asset('public/js/app/body.js'. App\Logic\Helpers::production("version"))}}"></script>
    <script src="{{asset('public/js/slider.js'. App\Logic\Helpers::production("version"))}}"></script>
@endpush


<script>
function active(id){
	 $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url : "{{ url('save_status') }}",
        data : {'id' : id,'status':'active'},
        type : 'GET',
        dataType : 'json',
        success : function(result){

         
        }
    });
	
}

function inactive(id){
	 $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url : "{{ url('save_status') }}",
        data : {'id' : id,'status':'inactive'},
        type : 'GET',
        dataType : 'json',
        success : function(result){

         
        }
    });
	
}
</script>