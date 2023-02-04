@extends('layouts.master')
@section('css')

@toastr_css
@endsection

@section('title')
{{ trans('settings.title_page') }}
@stop

@section('page-header')
<!-- breadcrumb -->
<div class="page-title">

    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">{{ trans('main_sidebar.setting') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="default-color">{{
                        trans('main_sidebar.Dashboard') }}</a></li>
                <li class="breadcrumb-item active">{{ trans('settings.title_page') }}</li>
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
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                {{-- <button type="button" class="button x-small" data-toggle="modal" data-effect="effect-scale"
                    href="#modaldemo1">{{ trans('settings.add') }}</button> --}}
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered p-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>{{ trans('settings.forceUpdate') }}</th>
                                <th>{{ trans('settings.lastBuild') }}</th>
                                <th>{{ trans('settings.website') }}</th>
                                <th>{{ trans('settings.whatsApp') }}</th>
                                <th>{{ trans('settings.phone') }}</th>
                                <th>{{ trans('settings.snap') }}</th>
                                <th>{{ trans('settings.Instagram') }}</th>
                                <th>{{ trans('settings.ticktock') }}</th>
                                <th>{{ trans('settings.policy') }}</th>
                                <th>{{ trans('settings.android') }}</th>
                                <th>{{ trans('settings.ios') }}</th>
                                <th>{{ trans('categories.operations') }}</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            @foreach ($settings as $settings)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $settings->forceUpdate }}</td>
                                <td>{{ $settings->lastBuild }}</td>
                                <td>{{ $settings->website }}</td>
                                <td>{{ $settings->whatsApp }}</td>
                                <td>{{ $settings->phone }}</td>
                                <td>{{ $settings->snap }}</td>
                                <td>{{ $settings->Instagram }}</td>
                                <td>{{ $settings->ticktock }}</td>
                                <td>{{ $settings->policy }}</td>
                                <td>{{ $settings->android }}</td>
                                <td>{{ $settings->ios }}</td>
                                <td>

                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                        data-target="#edit{{ $settings->id }}"
                                        title="{{ trans('settings.edit') }}"><i class="fa fa-edit"></i></button>

                                </td>
                            </tr>


                            <!-- Basic modal Edit -->
                            <div class="modal fade" id="edit{{ $settings->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                {{ trans('settings.edit') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- add_form -->
                                            <form action="{{ route('settings.update', 'test') }}" method="post">
                                                {{ method_field('patch') }}
                                                @csrf
                                                <div class="row">
                                                    <div class="col">
                                                        <input type="hidden" class="form-control"
                                                            value="{{ $settings->id }}"
                                                            name="id" required>
                                                        <label for="forceUpdate" class="mr-sm-2">{{
                                                            trans('settings.forceUpdate') }}
                                                            :</label>

                                                            <select class="form-control" id="forceUpdate" name="forceUpdate">
                                                                <option value="1">{{ trans('settings.updated') }}</option>
                                                                <option value="0">{{ trans('settings.notupdated') }}
                                                                </option>
                                                            </select>
                                                    </div>
                                                    <div class="col">
                                                        <label for="lastBuild" class="mr-sm-2">{{
                                                            trans('settings.lastBuild') }}
                                                            :</label>
                                                        <input type="number" class="form-control"
                                                            value="{{ $settings->lastBuild }}"
                                                            name="lastBuild" required>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col">
                                                        <label for="website" class="mr-sm-2">{{
                                                            trans('settings.website') }}
                                                            :</label>

                                                            <input type="text" class="form-control"
                                                            value="{{ $settings->website }}"
                                                            name="website" required>
                                                    </div>
                                                    <div class="col">
                                                        <label for="whatsApp" class="mr-sm-2">{{
                                                            trans('settings.whatsApp') }}
                                                            :</label>
                                                        <input type="text" class="form-control"
                                                            value="{{ $settings->whatsApp }}"
                                                            name="whatsApp" required>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col">
                                                        <label for="phone" class="mr-sm-2">{{
                                                            trans('settings.phone') }}
                                                            :</label>

                                                            <input type="text" class="form-control"
                                                            value="{{ $settings->phone }}"
                                                            name="phone" required>
                                                    </div>
                                                    <div class="col">
                                                        <label for="snap" class="mr-sm-2">{{
                                                            trans('settings.snap') }}
                                                            :</label>
                                                        <input type="text" class="form-control"
                                                            value="{{ $settings->snap }}"
                                                            name="snap" required>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col">
                                                        <label for="Instagram" class="mr-sm-2">{{
                                                            trans('settings.Instagram') }}
                                                            :</label>

                                                            <input type="text" class="form-control"
                                                            value="{{ $settings->Instagram }}"
                                                            name="Instagram" required>
                                                    </div>
                                                    <div class="col">
                                                        <label for="ticktock" class="mr-sm-2">{{
                                                            trans('settings.ticktock') }}
                                                            :</label>
                                                        <input type="text" class="form-control"
                                                            value="{{ $settings->ticktock }}"
                                                            name="ticktock" required>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col">
                                                        <label for="policy" class="mr-sm-2">{{
                                                            trans('settings.policy') }}
                                                            :</label>

                                                            <input type="text" class="form-control"
                                                            value="{{ $settings->policy }}"
                                                            name="policy" required>
                                                    </div>
                                                    <div class="col">
                                                        <label for="android" class="mr-sm-2">{{
                                                            trans('settings.android') }}
                                                            :</label>
                                                        <input type="text" class="form-control"
                                                            value="{{ $settings->android }}"
                                                            name="android" required>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col">
                                                        <label for="ios" class="mr-sm-2">{{
                                                            trans('settings.ios') }}
                                                            :</label>

                                                            <input type="text" class="form-control"
                                                            value="{{ $settings->ios }}"
                                                            name="ios" required>
                                                    </div>

                                                </div>


                                                <br><br>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">{{ trans('categories.close') }}</button>
                                                    <button type="submit" class="btn btn-success">{{
                                                        trans('categories.submit') }}</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Basic modal -->

                            @endforeach

                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->

@endsection


@section('js')

@toastr_js
@toastr_render

@endsection
