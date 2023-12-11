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
		<h1 class="text-center">How many times do you want your Transfer to run?</h1>
    </div>

	<div  class="row div2">
		<div class="col-1">
		</div>
		<div class="col-4 card shadow card1">
			<div class="row svg">
				<svg fill="white" height="116" viewBox="0 0 107 116" width="107" xmlns="http://www.w3.org/2000/svg"><rect fill="white" height="106" rx="10.5" stroke="#2d2e2e" width="106" x="0.5" y="0.5"></rect><path d="M84.0294 53.5002L24.5469 25.334L28.3794 47.1477L45.6256 55.259V61.0602L29.5081 53.474V53.5002L24.5469 81.6665L84.0294 53.5002Z" fill="#C1B7FF"></path></svg>
			</div>
			<div class="row font1">
				<p class="text-center">Move data one time</p>
			</div>
			<div class="row">
				<p class="text-center">Move data one time to catch up a system that’s fallen out of sync</p>
			</div>
			<div class="row justify-content-center">
				<a href="{{route('Apps.new_transfers','run')}}" class="btn text-white shadow">Run once</a>
			</div>
		</div>
		<div class="col-4 card shadow card2">
			<div class="row svg">
				<svg fill="none" height="116" viewBox="0 0 120 116" width="120" xmlns="http://www.w3.org/2000/svg"><rect fill="white" height="106" rx="10.5" stroke="#2D2E2E" width="106" x="0.5" y="0.5"></rect><path d="M45.625 84.1074L75.9175 48.0137H61.375V22.4199L31.0825 58.5137H45.625V84.1074Z" fill="#FF4F00"></path><path d="M99.9999 112.667C103.296 112.667 106.519 111.69 109.259 109.858C112 108.027 114.136 105.424 115.398 102.379C116.659 99.3333 116.989 95.9822 116.346 92.7492C115.703 89.5161 114.116 86.5464 111.785 84.2155C109.454 81.8847 106.484 80.2973 103.251 79.6542C100.018 79.0112 96.6673 79.3412 93.6219 80.6027C90.5764 81.8641 87.9734 84.0003 86.1421 86.7412C84.3107 89.482 83.3333 92.7043 83.3333 96.0007C83.3333 100.421 85.0892 104.66 88.2148 107.786C89.7624 109.333 91.5998 110.561 93.6219 111.399C95.644 112.236 97.8112 112.667 99.9999 112.667V112.667ZM98.3333 95.2173V87.6673H101.667V96.784L95.1166 102.284L92.9666 99.7173L98.3333 95.2173Z" fill="#FFBF6E"></path></svg>
			</div>
			<div class="row font1">
				<p class="text-center">Move data on a fixed schedule</p>
			</div>
			<div class="row">
				<p class="text-center">Move data daily, weekly, or monthly based on pre-set filters</p>
			</div>
			<div class="row justify-content-center">
				<a href="{{route('Apps.new_transfers','schedule')}}"  class="btn text-white shadow">Schedule</a>
			</div>
		</div>
		<div class="col-1">
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