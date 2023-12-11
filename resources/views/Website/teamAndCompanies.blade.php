@extends('Layouts.website')
@section('title', 'Team And Companies | LightNit')
@section('description', "This is an Automation Project")

@push('headerScript')
    <link rel="stylesheet" href="{{asset('public/css/bootstrap.min.css')}}">
    <!--======= Font Asesome cdn Link =======-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
          integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="{{asset('public/css/style.css' . App\Logic\Helpers::production("version"))}}">
    <link rel="stylesheet" href="{{asset('public/css/style2.css' . App\Logic\Helpers::production("version"))}}">
    <link rel="stylesheet" href="{{asset('public/css/responsive.css' . App\Logic\Helpers::production("version"))}}">
    <link rel="stylesheet" href="{{asset('public/css/responsive2.css' . App\Logic\Helpers::production("version"))}}">
    <link rel="stylesheet" href="{{asset('public/css/tmc.css' . App\Logic\Helpers::production("version"))}}">
    <link rel="stylesheet" href="{{asset('public/css/tmc_res.css' . App\Logic\Helpers::production("version"))}}">
@endpush
@section("content")
    {!! App\Logic\Notification::get('top')  !!}
    {{--Include Header--}}
    @includeIf('Website.Components.Common.HeaderMenu')
    <div class="tmc">

        {{--Include Header--}}
        @includeIf('Website.Components.TMC.requestDemo')

        {{--Include Offer--}}
        @includeIf('Website.Components.TMC.forTeams')

        {{--Include Company--}}
        @includeIf('Website.Components.TMC.Companies')

        {{--Include Power--}}
        @includeIf('Website.Components.TMC.Power')

        {{--Include Testimonial--}}
        @includeIf('Website.Components.TMC.Testimonial')

        {{--Include Business--}}
        @includeIf('Website.Components.TMC.Business')

        {{--Include FAQ--}}
        @includeIf('Website.Components.FAQ.TMC_QUESTIONS')

        {{--Include Footer--}}
        @includeIf('Website.Components.Common.SortFooter')
    </div>
    {!! App\Logic\Notification::get('bottom')  !!}

@endsection



@push('footerScript')
    <script src="{{asset('public/js/jquery-1.12.4.min.js')}}"></script>
    <script src="{{asset('public/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('public/js/fontawsome.js')}}"></script>
    <script src="{{asset('public/js/script.js'. App\Logic\Helpers::production("version"))}}"></script>
@endpush
