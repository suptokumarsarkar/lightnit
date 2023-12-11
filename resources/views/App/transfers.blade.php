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
@endpush
@section("content")
    {!! App\Logic\Notification::get('top')  !!}

    {{--Include Header--}}
    @includeIf('App.Components.Warning')

    {{--Include Header--}}
    @includeIf('App.Components.Header')

    {{--Include Body--}}
    @includeIf('App.Components.transfers')

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