@extends('layouts.master')
@section('css')

@toastr_css
@endsection

@section('title')
{{ trans('cities.title_page') }}
@stop

@section('page-header')
<!-- breadcrumb -->
<div class="page-title">

    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">{{ trans('main_sidebar.City_list') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="default-color">{{ trans('main_sidebar.Dashboard') }}</a></li>
                <li class="breadcrumb-item active">{{ trans('cities.title_page') }}</li>
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
               
                <button type="button" class="button x-small" data-toggle="modal" data-effect="effect-scale" href="#modaldemo1">{{ trans('cities.add') }}</button>
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered p-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>{{ trans('cities.name_city') }}</th>
                                <th>{{ trans('cities.location_city') }}</th>
                                <th>{{ trans('cities.country_city') }}</th>
                                <th>{{ trans('cities.operations') }}</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            @foreach ($cities as $cities)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $cities->name }}</td>
                                <td>{{ $cities->location }}</td>
                                <td>{{ $cities->country ? ($cities->country->name ?  $cities->country->name : "" ): "" }}</td>
                                <td>
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit{{ $cities->id }}" title="{{ trans('cities.edit') }}"><i class="fa fa-edit"></i></button>

                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete{{ $cities->id }}" title="{{ trans('cities.delete') }}"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>


                            <!-- Basic modal Edit -->
                            <div class="modal fade" id="edit{{ $cities->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                                                {{ trans('cities.edit') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- add_form -->
                                            <form action="{{ route('cities.update', 'test') }}" method="post">
                                                {{ method_field('patch') }}
                                                @csrf
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="Name" class="mr-sm-2">{{
                                                            trans('cities.city_name_ar') }}
                                                            :</label>
                                                        <input id="name" type="text" name="name" class="form-control" value="{{ $cities->getTranslation('name', 'ar') }}" required>
                                                        <input id="id" type="hidden" name="id" class="form-control" value="{{ $cities->id }}">
                                                    </div>
                                                    <div class="col">
                                                        <label for="Name_en" class="mr-sm-2">{{
                                                            trans('cities.city_name_en') }}
                                                            :</label>
                                                        <input type="text" class="form-control" value="{{ $cities->getTranslation('name', 'en') }}" name="name_en" required>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label>{{ trans('cities.location') }}</label>
                                                    <textarea class="form-control" id="location" name="location"></textarea>
                                                </div>

                                                <div class="form-group">
                                                    <label>{{ trans('cities.country_name') }}</label>
                                                    <select class="form-control" name="country_id">
                                                        <option disabled selected>{{ trans('cities.select_country') }}</option>
                                                        @foreach($countries as $country)
                                                        @if($country->id == $cities->country->id)
                                                        <option value="{{$country->id}}" selected>{{$country->name}}</option>
                                                        @else
                                                        <option value="{{$country->id}}">{{$country->name}}</option>

                                                        @endif

                                                        @endforeach
                                                    </select>
                                                </div>

                                                <br><br>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('cities.close') }}</button>
                                                    <button type="submit" class="btn btn-success">{{
                                                        trans('cities.submit') }}</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Basic modal -->

                            <!-- delete cities -->
                            <div class="modal fade" id="delete{{ $cities->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                                                {{ trans('cities.delete') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{route('cities.destroy', 'test')}}" method="post">
                                                {{method_field('Delete')}}
                                                @csrf
                                                {{ trans('cities.warning_city') }}
                                                <input id="id" type="hidden" name="id" class="form-control" value="{{ $cities->id }}">
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('cities.close') }}</button>
                                                    <button type="submit" class="btn btn-danger">{{ trans('cities.submit') }}</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end cities -->
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
                <h6 class="modal-title">{{ trans('cities.add_city') }}</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <form class="modal_forms" action="{{ route('cities.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>{{ trans('cities.city_name_ar') }}</label>

                        <input type="text" class="form-control" id="name" name="name">
                        <span class="text-danger error" id="name_error"></span>
                    </div>

                    <div class="form-group">
                        <label>{{ trans('cities.city_name_en') }}</label>
                        <input type="text" class="form-control" id="name_en" name="name_en">
                        <span class="text-danger error" id="name_en_error"></span>
                    </div>

                    <div class="form-group">
                        <label>{{ trans('cities.location') }}</label>
                        <textarea class="form-control" id="location" name="location"></textarea>
                        <span class="text-danger error" id="location_error"></span>
                    </div>

                    <div class="form-group">
                        <label>{{ trans('cities.country_name') }}</label>
                        <select class="form-control" name="country_id">
                            <option disabled selected>{{ trans('cities.select_country') }}</option>
                            @foreach($countries as $country)
                            <option value="{{$country->id}}">{{$country->name}}</option>

                            @endforeach
                        </select>
                        <span class="text-danger error" id="country_id_error"></span>

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="button x-small">{{ trans('cities.submit') }}</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('cities.close')
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
