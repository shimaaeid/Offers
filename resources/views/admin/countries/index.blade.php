@extends('layouts.master')
@section('css')

@toastr_css
@endsection

@section('title')
{{ trans('countries.title_page') }}
@stop

@section('page-header')
<!-- breadcrumb -->
<div class="page-title">

    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">{{ trans('main_sidebar.Country_list') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="default-color">{{
                        trans('main_sidebar.Dashboard') }}</a></li>
                <li class="breadcrumb-item active">{{ trans('countries.title_page') }}</li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection

@section('content')
<!-- row -->
<div class="row">
    <div class="col-xl-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

                <button type="button" class="button x-small" data-toggle="modal" data-effect="effect-scale"
                    href="#modaldemo1">{{ trans('countries.add') }}</button>
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered p-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>{{ trans('countries.name_country') }}</th>
                                <th>{{ trans('countries.flag_country') }}</th>
                                <th>{{ trans('countries.operations') }}</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            @foreach ($countries as $countries)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $countries->name }}</td>
                                    <td><img src="{{ asset($countries->flag) }}" width="100px" height="100px"
                                            class="img-fluid"></td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                            data-target="#edit{{ $countries->id }}" title="{{ trans('countries.edit') }}"><i
                                                class="fa fa-edit"></i></button>

                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                            data-target="#delete{{ $countries->id }}"
                                            title="{{ trans('countries.delete') }}"><i class="fa fa-trash"></i></button>

                                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal"
                                            data-target="#image{{ $countries->id }}"
                                            title="{{ trans('countries.image') }}"><i class="fa fa-flag"></i></button>
                                    </td>
                                </tr>


                                <!-- Basic modal Edit -->
                                <div class="modal fade" id="edit{{ $countries->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                    id="exampleModalLabel">
                                                    {{ trans('countries.edit') }}
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- edit_form -->
                                                <form class="modal_forms" action="{{ route('countries.update', 'test') }}" method="post">
                                                    {{ method_field('patch') }}
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col">
                                                            <input id="id" type="hidden" name="id" class="form-control"
                                                                value="{{ $countries->id }}">

                                                            <label for="Name" class="mr-sm-2">{{
                                                                trans('countries.country_name_ar') }}
                                                                :</label>
                                                            <input  type="text" id="name" name="name" class="form-control"
                                                                value="{{ $countries->getTranslation('name', 'ar') }}">
                                                                <span class="text-danger error" id="name_error"></span>
                                                        </div>

                                                        <div class="col">
                                                            <label for="Name_en" class="mr-sm-2">{{
                                                                trans('countries.country_name_en') }}
                                                                :</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ $countries->getTranslation('name', 'en') }}"
                                                                name="name_en" id="name_en">
                                                                <span class="text-danger error" id="name_en_error"></span>
                                                        </div>
                                                    </div>

                                                    <br><br>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">{{ trans('countries.close') }}</button>
                                                        <button type="submit" class="btn btn-success">{{
                                                            trans('countries.submit') }}</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Basic modal -->

                                <!-- Basic modal Edit flag-->
                                <div class="modal fade" id="image{{ $countries->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                    id="exampleModalLabel">
                                                    {{ trans('countries.image') }}
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- add_form -->
                                                <form  action="{{ route('updateFlag') }}" method="post"
                                                    enctype="multipart/form-data">
                                                    {{ method_field('POST') }}
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col">
                                                            <label for="Flag" class="mr-sm-2">{{trans('countries.image') }}
                                                                :</label>
                                                            <input id="id" type="hidden" name="id" class="form-control"
                                                                value="{{ $countries->id }}">

                                                            <input id="flag" type="file" name="flag" class="form-control"
                                                                required>
                                                                <span class="text-danger error" id="flag_error"></span>
                                                        </div>

                                                    </div>


                                                    <br><br>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">{{ trans('countries.close') }}</button>
                                                        <button type="submit" class="btn btn-success">{{
                                                            trans('countries.submit') }}</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Basic modal -->

                                <!-- delete countries -->
                                <div class="modal fade" id="delete{{ $countries->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                    id="exampleModalLabel">
                                                    {{ trans('countries.delete') }}
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('countries.destroy','test')}}" method="post">
                                                    {{method_field('Delete')}}
                                                    @csrf
                                                    {{ trans('countries.warning_country') }}
                                                    <input id="id" type="hidden" name="id" class="form-control"
                                                        value="{{ $countries->id }}">
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">{{ trans('countries.close') }}</button>
                                                        <button type="submit" class="btn btn-danger">{{
                                                            trans('countries.submit') }}</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end countries -->

                            @endforeach

                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>


</div>
<!-- row closed -->
<!-- Basic modal ADD -->
<div class="modal" id="modaldemo1">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">{{ trans('countries.add_country') }}</h6><button aria-label="Close"
                    class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <form class="modal_forms" action="{{ route('countries.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>{{ trans('countries.country_name_ar') }}</label>

                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" >
                        <span class="text-danger error" id="name_error"></span>
                    </div>

                    <div class="form-group">
                        <label>{{ trans('countries.country_name_en') }}</label>
                        <input type="text" class="form-control" id="name_en" name="name_en" value="{{ old('name_en') }}" >
                        <span class="text-danger error" id="name_en_error"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label>{{ trans('countries.flag_country') }}</label>
                    <input type="file" class="form-control" id="flag" name="flag" value="{{ old('flag') }}">
                    <span class="text-danger error" id="flag_error"></span>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="button x-small">{{ trans('countries.submit') }}</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('countries.close')
                        }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Basic modal -->
@endsection

@section('js')

@toastr_js
@toastr_render

@endsection
