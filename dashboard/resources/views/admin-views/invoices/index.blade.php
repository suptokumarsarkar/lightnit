@extends('layouts.admin.app')

@section('title', \App\CentralLogics\translate('Admin List'))

@push('css_or_js')

@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-sm mb-2 mb-sm-0">
                    <h1 class="page-header-title"><i class="tio-add-circle-outlined"></i> {{\App\CentralLogics\translate('Invoices List')}}</h1>
                </div>
            </div>
        </div>
        <!-- End Page Header -->
        <div class="row gx-2 gx-lg-3">
            @php($language = \App\Model\BusinessSetting::where('key', 'language')->first())
            @php($language = $language->value ?? null)
            @php($default_lang = 'en')


            <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
                <div class="card">
                    <div class="card-header flex-between">
                        <div class="flex-start">
                            <h5 class="card-header-title">{{\App\CentralLogics\translate("All Invoices")}}</h5>
                            <h5 class="card-header-title text-primary mx-1">({{ $invoices->total() }})</h5>
                        </div>
                        <div>
                            <form action="{{url()->current()}}" method="GET">
                                <div class="input-group">
                                    <input id="datatableSearch_" type="search" name="search"
                                           class="form-control"
                                           placeholder="{{\App\CentralLogics\translate('Search')}}" aria-label="Search"
                                           value="{{$search}}" required autocomplete="off">
                                    <div class="input-group-append">
                                        <button type="submit" class="input-group-text"><i class="tio-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Table -->
                    <div class="table-responsive datatable-custom">
                        <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                            <thead class="thead-light">
                            <tr>
                                <th>{{\App\CentralLogics\translate('#')}}</th>
                                <th style="width: 25%">{{\App\CentralLogics\translate('Name')}}</th>
                                <th style="width: 20%">{{\App\CentralLogics\translate('Email')}}</th>
                                <th style="width: 20%">{{\App\CentralLogics\translate('Plan Name')}}</th>
                                <th style="width: 20%">{{\App\CentralLogics\translate('Plan Amount')}}</th>
                                <th style="width: 20%">{{\App\CentralLogics\translate('Date')}}</th>
                                <th style="width: 20%">{{\App\CentralLogics\translate('Status')}}</th>
                                <th style="width: 20%">{{\App\CentralLogics\translate('Transaction Id')}}</th>
                                <!--<th style="width: 10%">{{\App\CentralLogics\translate('action')}}</th>-->
                            </tr>

                            </thead>

                            <tbody>
                            @foreach($invoices as $key=>$customer)
                                <tr>
                                    <td>{{$invoices->firstitem()+$key}}</td>
                                    <td>
                                        {{$customer['name']}}
                                    </td>
                                    <td>
                                    <span class="d-block font-size-sm text-body">
                                        {{$customer['email']}}
                                    </span>
                                    </td>
                                    <td>
                                        {{$customer['plan_name']}}
                                    </td>
									<td>
                                        $ {{$customer['amount']}}
                                    </td>
									<td>
									<?php echo date('m-d-Y H:i:s',strtotime($customer['created_at']));?>
                                    </td>
                                    <td>
									{{$customer['status'] }}
                                    </td>
									 <td>
									<?php echo (json_decode($customer['response'])->id);?>
                                    </td>
                                    <!--<td>
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle" type="button"
                                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                <i class="tio-settings"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item"
                                                   href="{{route('admin.adminEdit',[$customer['id']])}}">{{\App\CentralLogics\translate('edit')}}</a>
                                               
                                            </div>
                                        </div>
                                    </td>-->
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <hr>
                        <table>
                            <tfoot>
                            {!! $invoices->links() !!}
                            </tfoot>
                        </table>

                    </div>
                </div>
            </div>
            <!-- End Table -->
        </div>
    </div>

@endsection

@push('script_2')
    <script>
        $(".lang_link").click(function(e){
            e.preventDefault();
            $(".lang_link").removeClass('active');
            $(".lang_form").addClass('d-none');
            $(this).addClass('active');

            let form_id = this.id;
            let lang = form_id.split("-")[0];
            console.log(lang);
            $("#"+lang+"-form").removeClass('d-none');
            if(lang == '{{$default_lang}}')
            {
                $(".from_part_2").removeClass('d-none');
            }
            else
            {
                $(".from_part_2").addClass('d-none');
            }
        });
    </script>
    <script>
        $(document).on('ready', function () {
            // INITIALIZATION OF DATATABLES
            // =======================================================
            // var datatable = $.HSCore.components.HSDatatables.init($('#columnSearchDatatable'));

            var datatable = $('.table').DataTable({
                "paging": false
            });

            $('#column1_search').on('keyup', function () {
                datatable
                    .columns(1)
                    .search(this.value)
                    .draw();
            });


            $('#column3_search').on('change', function () {
                datatable
                    .columns(2)
                    .search(this.value)
                    .draw();
            });


            // INITIALIZATION OF SELECT2
            // =======================================================
            $('.js-select2-custom').each(function () {
                var select2 = $.HSCore.components.HSSelect2.init($(this));
            });
        });
    </script>

    <script>
        function readURL(input, viewer_id) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#'+viewer_id).attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#customFileEg1").change(function () {
            readURL(this, 'viewer');
        });
        $("#customFileEg2").change(function () {
            readURL(this, 'viewer2');
        });
    </script>
@endpush
