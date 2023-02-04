@extends('layouts.master')
@section('css')

<link rel="stylesheet" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap-theme/select2-bootstrap.min.css') }}">
<style>
    .select2-selection {
        /* padding: 10px; */
        width: 150px;
        border: none;
        margin: 9px;

    }

    .select2-container .select2-selection--single {
        height: 45px;

    }

    .select2-selection__rendered {
        margin-top: -7px;
    }
</style>

@toastr_css
@endsection

@section('title')
{{ trans('shops.title_page') }}
@stop

@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">{{ trans('main_sidebar.Shop_list') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="default-color">{{
                        trans('main_sidebar.Dashboard') }}</a></li>
                <li class="breadcrumb-item active">{{ trans('shops.title_page') }}</li>
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
                <button type="button" class="button x-small" data-toggle="modal" data-effect="effect-scale"
                    href="#modaldemo1">{{ trans('shops.add') }}</button>
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered p-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>{{ trans('shops.name_shop') }}</th>
                                <th>{{ trans('shops.email') }}</th>
                                <th>{{ trans('shops.phone') }}</th>
                                <th>{{ trans('shops.whatsapp') }}</th>
                                <th>{{ trans('shops.country') }}</th>
                                <th>{{ trans('shops.cities_name') }}</th>
                                <th>{{ trans('shops.operations') }}</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            @foreach ($shops as $shops)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>
                                    <a type="button" class="btn  btn-sm" data-effect="effect-scale" data-toggle="modal"
                                        data-target="#show{{ $shops->id }}">
                                        {{ $shops->name }}
                                    </a>
                                </td>
                                <td>{{ $shops->email }}</td>
                                <td>{{ $shops->phone }}</td>
                                <td>{{ $shops->whatsapp }}</td>
                                {{-- <td>{{ $shops->cities->first()->country->name }}</td> --}}
                                <td>{{ $shops->cities ? ($shops->cities->first() ? ($shops->cities->first()->country ?
                                    ($shops->cities->first()->country->name ? $shops->cities->first()->country->name :
                                    "" ) : "") : "" ) : "" }}</td>

                                <td>
                                    @foreach ($shops->cities as $cities)
                                    {{ $cities->name }} <br>
                                    @endforeach
                                </td>

                                <td>
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                        data-target="#edit{{ $shops->id }}" title="{{ trans('shops.edit') }}"><i
                                            class="fa fa-edit"></i></button>
                                    {{-- <a type="button" class="btn btn-info btn-sm"
                                        href="{{ route('shops.edit', $shops->id) }}"
                                        title="{{ trans('shops.edit') }}"><i class="fa fa-edit"></i></a> --}}

                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                        data-target="#delete{{ $shops->id }}" title="{{ trans('shops.delete') }}"><i
                                            class="fa fa-trash"></i></button>
                                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal"
                                        data-target="#profile_path{{ $shops->id }}"
                                        title="{{ trans('shops.profile_path') }}"><i class="fa fa-image"></i></button>
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                        data-target="#cover_path{{ $shops->id }}"
                                        title="{{ trans('shops.cover_path') }}"><i class="fa fa-image"></i></button>
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                        data-target="#edit_cities{{ $shops->id }}"
                                        title="{{ trans('shops.edit_cities') }}"><i class="ti-palette"></i></button>
                                    <button type="button" class="btn btn-sm btn-success" data-effect="effect-scale"
                                        data-toggle="modal" data-target="#edit_status{{ $shops->id }}"
                                        title="{{ trans('shops.status') }}"><i
                                            class="fa-solid fa-battery-half"></i></button>



                                </td>
                            </tr>

                            <!-- Basic modal Edit cities-->
                            <div class="modal fade" id="show{{ $shops->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                {{ trans('shops.details') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- add_form -->
                                            <form>

                                                @csrf
                                                <div class="modal-body">

                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label>{{ trans('shops.shop_name_ar') }}</label>
                                                                <input type="hidden" class="form-control" id="id"
                                                                    name="id" value="{{ $shops->id }}">

                                                                <input type="text" class="form-control" id="name"
                                                                    name="name" disabled
                                                                    value="{{ $shops->getTranslation('name', 'ar') }}">
                                                            </div>
                                                        </div>

                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label>{{ trans('shops.shop_name_en') }}</label>
                                                                <input type="text" class="form-control" id="name_en"
                                                                    name="name_en" disabled
                                                                    value="{{ $shops->getTranslation('name', 'en') }}">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>{{ trans('shops.email') }}</label>
                                                        <input type="email" disabled class="form-control" id="email" name="email"
                                                            value="{{ $shops->email }}">
                                                    </div>


                                                    <div class="form-group">
                                                        <label>{{ trans('shops.phone') }}</label>
                                                        <input type="text" disabled class="form-control" id="phone" name="phone"
                                                            value="{{ $shops->phone }}">
                                                    </div>

                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label>{{ trans('shops.shop_opening_hours_ar')
                                                                    }}</label>

                                                                <input type="text" disabled  class="form-control"
                                                                    id="opening_hours" name="opening_hours"
                                                                    value="{{ $shops->getTranslation('opening_hours', 'ar') }}">
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label>{{ trans('shops.shop_opening_hours_en')
                                                                    }}</label>
                                                                <input type="text" disabled class="form-control"
                                                                    id="opening_hours_en" name="opening_hours_en"
                                                                    value="{{ $shops->getTranslation('opening_hours', 'en') }}">
                                                            </div>

                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label>{{ trans('shops.country_name') }}</label>
                                                                <input type="text" disabled class="form-control"
                                                                    id="country_id" name="country_id"
                                                                    value="{{ $shops->cities ? ($shops->cities->first() ? ($shops->cities->first()->country ?
                                                                        ($shops->cities->first()->country->name ? $shops->cities->first()->country->name :
                                                                        "" ) : "") : "" ) : "" }}">



                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="inputName" class="control-label">{{
                                                                    trans('shops.cities_name') }}</label>
                                                                    <br>

                                                                    @foreach ($shops->cities as $cities)
                                                                    {{ $cities->name }} <br>
                                                                    @endforeach


                                                            </div>

                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label>{{ trans('shops.shop_location_ar') }}</label>

                                                                <input type="text" disabled class="form-control" id="location"
                                                                    name="location"
                                                                    value="{{ $shops->getTranslation('location', 'ar') }}">
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label>{{ trans('shops.shop_location_en') }}</label>
                                                                <input type="text" disabled class="form-control" id="location_en"
                                                                    name="location_en"
                                                                    value="{{ $shops->getTranslation('location', 'en') }}">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>{{ trans('shops.location_url') }}</label>
                                                        <input type="text" disabled class="form-control" id="location_url"
                                                            name="location_url" value="{{ $shops->location_url }}">
                                                    </div>

                                                    <div class="form-group">
                                                        <label>{{ trans('shops.whatsapp') }}</label>
                                                        <input type="text" disabled class="form-control" id="whatsapp"
                                                            name="whatsapp" value="{{ $shops->whatsapp }}">
                                                    </div>

                                                    <div class="form-group">
                                                        <label>{{ trans('shops.insta') }}</label>
                                                        <input type="text" disabled class="form-control" id="insta" name="insta"
                                                            value="{{ $shops->insta }}">
                                                    </div>

                                                    <div class="form-group">
                                                        <label>{{ trans('shops.snap') }}</label>
                                                        <input type="text" disabled class="form-control" id="snap" name="snap"
                                                            value="{{ $shops->snap }}">
                                                    </div>

                                                    <div class="form-group">
                                                        <label>{{ trans('shops.web_site') }}</label>
                                                        <input type="text" disabled class="form-control" id="web_site"
                                                            name="web_site" value="{{ $shops->web_site }}">
                                                    </div>


                                                    <div class="form-group">
                                                        <label>{{ trans('shops.shopType') }}</label>
                                                        <input type="text" disabled class="form-control" id="shoptype_id"
                                                            name="webshoptype_id_site" value="{{  $shops->shopType->name }}">

                                                    </div>

                                                    <div class="form-group">
                                                        <label>{{ trans('shops.months') }}</label>
                                                        <input type="number" disabled class="form-control" id="months"
                                                            name="months" value="{{ $shops->months }}">
                                                    </div>

                                                    <div class="form-group">
                                                        <label>{{ trans('shops.category_name') }}</label>
                                                        <input type="text" disabled class="form-control" id="category_id"
                                                            name="category_id" value="{{ $shops->category->name }}">

                                                    </div>

                                                    <div class="form-group">
                                                        <label>{{ trans('shops.packagetype') }}</label>
                                                        <input type="text" disabled class="form-control" id="packagetype_id"
                                                        name="packagetype_id" value="{{ $shops->packageType->name }}">

                                                    </div>

                                                    <div class="form-group">
                                                        <label>{{ trans('shops.watchs') }}</label>
                                                        <input type="text" disabled class="form-control" id="watch"
                                                        name="watch" value="{{ $shops->watch }}">

                                                    </div>

                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label>{{ trans('shops.shop_description_ar') }}</label>

                                                                <textarea disabled class="form-control" id="description"
                                                                    name="description">{{ $shops->getTranslation('description', 'ar') }}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label>{{ trans('shops.shop_description_en') }}</label>
                                                                <textarea disabled class="form-control" id="description_en"
                                                                    name="description_en">{{ $shops->getTranslation('description', 'en') }}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <br><br>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">{{ trans('countries.close') }}</button>
                                                    
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Basic modal -->

                            <!-- Basic modal Edit status-->
                            <div class="modal fade" id="edit_status{{ $shops->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                {{ trans('shops.status') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- add_form -->
                                            <form action="{{ route('updateStatus') }}" method="post">
                                                {{ method_field('POST') }}
                                                @csrf
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <input id="id" type="hidden" name="id" class="form-control"
                                                                value="{{ $shops->id }}">
                                                            <label for="inputName" class="control-label">{{
                                                                trans('shops.status') }}</label>
                                                            <select class="form-control" id="active" name="active">
                                                                <option value="1">{{ trans('shops.active') }}</option>
                                                                <option value="0">{{ trans('shops.notactive') }}
                                                                </option>
                                                            </select>
                                                        </div>
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

                            <!-- Basic modal Edit cities-->
                            <div class="modal fade" id="edit_cities{{ $shops->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                {{ trans('shops.cities_name') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- add_form -->
                                            <form action="{{ route('updateCities') }}" method="post">
                                                {{ method_field('POST') }}
                                                @csrf
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label>{{ trans('shops.country_name') }}</label>
                                                            <input id="id" type="hidden" name="id" class="form-control"
                                                                value="{{ $shops->id }}">

                                                            <select name="country_id" class="form-control SlectBox"
                                                                onclick="console.log($(this).val())"
                                                                onchange="console.log('change is firing')">
                                                                <!--placeholder-->
                                                                <option value="" selected disabled>{{
                                                                    trans('shops.country_name') }}</option>
                                                                @foreach ($countries as $countriesC)
                                                                <option value="{{ $countriesC->id }}"> {{
                                                                    $countriesC->name }}</option>
                                                                @endforeach
                                                            </select>

                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="inputName" class="control-label">{{
                                                                trans('shops.cities_name') }}</label>
                                                            <select class="form-control select2" id="city_id[]"
                                                                name="city_id[]" multiple>
                                                            </select>
                                                        </div>

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

                            <!-- Basic modal Edit cover_path -->
                            <div class="modal fade" id="cover_path{{ $shops->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                {{ trans('shops.cover_path') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- add_form -->
                                            <form action="{{ route('updateCoverImage') }}" method="post"
                                                enctype="multipart/form-data">
                                                {{ method_field('POST') }}
                                                @csrf
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="Image" class="mr-sm-2">{{trans('shops.cover_path')
                                                            }}
                                                            :</label>
                                                        <input id="id" type="hidden" name="id" class="form-control"
                                                            value="{{ $shops->id }}">

                                                        <input type="file" id="cover_path" name="cover_path"
                                                            class="form-control" required>
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

                            <!-- Basic modal Edit profile_path-->
                            <div class="modal fade" id="profile_path{{ $shops->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                {{ trans('shops.profile_path') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- add_form -->
                                            <form action="{{ route('updateProfileImage') }}" method="post"
                                                enctype="multipart/form-data">
                                                {{ method_field('POST') }}
                                                @csrf
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="Image" class="mr-sm-2">{{trans('shops.profile_path')
                                                            }}
                                                            :</label>
                                                        <input id="id" type="hidden" name="id" class="form-control"
                                                            value="{{ $shops->id }}">

                                                        <input type="file" id="profile_path" name="profile_path"
                                                            class="form-control" required>
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


                            <!-- Basic modal Edit -->
                            <div class="modal fade" id="edit{{ $shops->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                {{ trans('shops.edit') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- add_form -->
                                            <form action="{{ route('shops.update', 'test') }}" method="post">
                                                {{ method_field('patch') }}
                                                @csrf
                                                <div class="modal-body">

                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label>{{ trans('shops.shop_name_ar') }}</label>
                                                                <input type="hidden" class="form-control" id="id"
                                                                    name="id" value="{{ $shops->id }}">

                                                                <input type="text" class="form-control" id="name"
                                                                    name="name"
                                                                    value="{{ $shops->getTranslation('name', 'ar') }}">
                                                            </div>
                                                        </div>

                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label>{{ trans('shops.shop_name_en') }}</label>
                                                                <input type="text" class="form-control" id="name_en"
                                                                    name="name_en"
                                                                    value="{{ $shops->getTranslation('name', 'en') }}">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>{{ trans('shops.email') }}</label>
                                                        <input type="email" class="form-control" id="email" name="email"
                                                            value="{{ $shops->email }}">
                                                    </div>

                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label>{{ trans('shops.password') }}</label>
                                                                <input type="password" class="form-control"
                                                                    id="password" name="password"
                                                                    value="{{ $shops->password }}">
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label>{{ trans('shops.password_confirmation')
                                                                    }}</label>
                                                                <input type="password" class="form-control"
                                                                    id="password_confirmation"
                                                                    name="password_confirmation">
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>{{ trans('shops.phone') }}</label>
                                                        <input type="text" class="form-control" id="phone" name="phone"
                                                            value="{{ $shops->phone }}">
                                                    </div>

                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label>{{ trans('shops.shop_opening_hours_ar')
                                                                    }}</label>

                                                                <input type="text" class="form-control"
                                                                    id="opening_hours" name="opening_hours"
                                                                    value="{{ $shops->getTranslation('opening_hours', 'ar') }}">
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label>{{ trans('shops.shop_opening_hours_en')
                                                                    }}</label>
                                                                <input type="text" class="form-control"
                                                                    id="opening_hours_en" name="opening_hours_en"
                                                                    value="{{ $shops->getTranslation('opening_hours', 'en') }}">
                                                            </div>

                                                        </div>
                                                    </div>
                                                    {{--
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label>{{ trans('shops.country_name') }}</label>
                                                                <select name="country_id" class="form-control SlectBox"
                                                                    onclick="console.log($(this).val())"
                                                                    onchange="console.log('change is firing')" multiple>
                                                                    <!--placeholder-->
                                                                    <option value="" selected disabled>{{
                                                                        trans('shops.country_name') }}</option>
                                                                    @foreach ($countries as $countriest)
                                                                    @if($countriest->id == $shops->city->country->id)

                                                                    <option value="{{ $countriest->id }}" selected> {{
                                                                        $countriest->name }}</option>
                                                                    @else
                                                                    <option value="{{ $countriest->id }}"> {{
                                                                        $countriest->name }}</option>
                                                                    @endif
                                                                    @endforeach
                                                                </select>

                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="inputName" class="control-label">{{
                                                                    trans('shops.cities_name') }}</label>
                                                                <select id="city_id" name="city_id"
                                                                    class="form-control">
                                                                </select>
                                                            </div>

                                                        </div>
                                                    </div> --}}

                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label>{{ trans('shops.shop_location_ar') }}</label>

                                                                <input type="text" class="form-control" id="location"
                                                                    name="location"
                                                                    value="{{ $shops->getTranslation('location', 'ar') }}">
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label>{{ trans('shops.shop_location_en') }}</label>
                                                                <input type="text" class="form-control" id="location_en"
                                                                    name="location_en"
                                                                    value="{{ $shops->getTranslation('location', 'en') }}">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>{{ trans('shops.location_url') }}</label>
                                                        <input type="text" class="form-control" id="location_url"
                                                            name="location_url" value="{{ $shops->location_url }}">
                                                    </div>

                                                    <div class="form-group">
                                                        <label>{{ trans('shops.whatsapp') }}</label>
                                                        <input type="text" class="form-control" id="whatsapp"
                                                            name="whatsapp" value="{{ $shops->whatsapp }}">
                                                    </div>

                                                    <div class="form-group">
                                                        <label>{{ trans('shops.insta') }}</label>
                                                        <input type="text" class="form-control" id="insta" name="insta"
                                                            value="{{ $shops->insta }}">
                                                    </div>

                                                    <div class="form-group">
                                                        <label>{{ trans('shops.snap') }}</label>
                                                        <input type="text" class="form-control" id="snap" name="snap"
                                                            value="{{ $shops->snap }}">
                                                    </div>

                                                    <div class="form-group">
                                                        <label>{{ trans('shops.web_site') }}</label>
                                                        <input type="text" class="form-control" id="web_site"
                                                            name="web_site" value="{{ $shops->web_site }}">
                                                    </div>


                                                    <div class="form-group">
                                                        <label>{{ trans('shops.shopType') }}</label>
                                                        <select class="form-control" name="shoptype_id">
                                                            <option disabled selected>{{ trans('shops.shopType') }}
                                                            </option>
                                                            @foreach($shopType as $shoptest)
                                                            @if ($shoptest->id == $shops->shopType->id)
                                                            <option value="{{$shoptest->id}}" selected>
                                                                {{$shoptest->name}}</option>
                                                            @else
                                                            <option value="{{$shoptest->id}}">{{$shoptest->name}}
                                                            </option>

                                                            @endif

                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>{{ trans('shops.months') }}</label>
                                                        <input type="number" class="form-control" id="months"
                                                            name="months" value="{{ $shops->months }}">
                                                    </div>

                                                    <div class="form-group">
                                                        <label>{{ trans('shops.category_name') }}</label>
                                                        <select class="form-control" name="category_id">
                                                            <option disabled selected>{{ trans('shops.category_name') }}
                                                            </option>
                                                            @foreach($categories as $categoryTest)
                                                            @if($categoryTest->id == $shops->category->id)
                                                            <option value="{{$categoryTest->id}}" selected>
                                                                {{$categoryTest->name}}</option>
                                                            @else
                                                            <option value="{{$categoryTest->id}}">
                                                                {{$categoryTest->name}}</option>
                                                            @endif
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>{{ trans('shops.packagetype') }}</label>
                                                        <select class="form-control" name="packagetype_id">
                                                            <option disabled selected>{{ trans('shops.packagetype') }}
                                                            </option>
                                                            @foreach($packageType as $packageTest)
                                                            @if($packageTest->id == $shops->packageType->id)
                                                            <option value="{{$packageTest->id}}" selected>
                                                                {{$packageTest->name}}</option>
                                                            @else
                                                            <option value="{{$packageTest->id}}">{{$packageTest->name}}
                                                            </option>
                                                            @endif

                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label>{{ trans('shops.shop_description_ar') }}</label>

                                                                <textarea class="form-control" id="description"
                                                                    name="description">{{ $shops->getTranslation('description', 'ar') }}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label>{{ trans('shops.shop_description_en') }}</label>
                                                                <textarea class="form-control" id="description_en"
                                                                    name="description_en">{{ $shops->getTranslation('description', 'en') }}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">{{ trans('shops.close') }}</button>
                                                    <button type="submit" class="btn btn-success">{{
                                                        trans('shops.submit') }}</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Basic modal -->

                            <!-- delete shop -->
                            <div class="modal fade" id="delete{{ $shops->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                {{ trans('shops.delete') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{route('shops.destroy', 'test')}}" method="post">
                                                {{method_field('Delete')}}
                                                @csrf
                                                {{ trans('shops.warning_shop') }}
                                                <input id="id" type="hidden" name="id" class="form-control"
                                                    value="{{ $shops->id }}">
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">{{ trans('shops.close') }}</button>
                                                    <button type="submit" class="btn btn-danger">{{
                                                        trans('shops.submit') }}</button>
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
                <h6 class="modal-title">{{ trans('shops.add_shop') }}</h6><button aria-label="Close" class="close"
                    data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{ route('shops.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>{{ trans('shops.shop_name_ar') }}</label>
                                <input type="text" class="form-control" id="name" name="name">
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label>{{ trans('shops.shop_name_en') }}</label>
                                <input type="text" class="form-control" id="name_en" name="name_en">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>{{ trans('shops.email') }}</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>{{ trans('shops.password') }}</label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label>{{ trans('shops.password_confirmation') }}</label>
                                <input type="password" class="form-control" id="password_confirmation"
                                    name="password_confirmation">
                            </div>

                        </div>
                    </div>



                    <div class="form-group">
                        <label>{{ trans('shops.phone') }}</label>
                        <input type="text" class="form-control" id="phone" name="phone">
                    </div>


                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>{{ trans('shops.shop_opening_hours_ar') }}</label>

                                <input type="text" class="form-control" id="opening_hours" name="opening_hours">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label>{{ trans('shops.shop_opening_hours_en') }}</label>
                                <input type="text" class="form-control" id="opening_hours_en" name="opening_hours_en">
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>{{ trans('shops.country_name') }}</label>
                                <select name="country_id" class="form-control SlectBox"
                                    onclick="console.log($(this).val())" onchange="console.log('change is firing')">
                                    <!--placeholder-->
                                    <option value="" selected disabled>{{ trans('shops.country_name') }}</option>
                                    @foreach ($countries as $countries)
                                    <option value="{{ $countries->id }}"> {{ $countries->name }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="inputName" class="control-label">{{ trans('shops.cities_name') }}</label>
                                <select class="form-control select2" id="city_id[]" name="city_id[]" multiple>
                                </select>
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>{{ trans('shops.shop_location_ar') }}</label>

                                <input type="text" class="form-control" id="location" name="location">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label>{{ trans('shops.shop_location_en') }}</label>
                                <input type="text" class="form-control" id="location_en" name="location_en">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>{{ trans('shops.location_url') }}</label>
                        <input type="text" class="form-control" id="location_url" name="location_url">
                    </div>

                    <div class="form-group">
                        <label>{{ trans('shops.whatsapp') }}</label>
                        <input type="text" class="form-control" id="whatsapp" name="whatsapp">
                    </div>

                    <div class="form-group">
                        <label>{{ trans('shops.insta') }}</label>
                        <input type="text" class="form-control" id="insta" name="insta">
                    </div>

                    <div class="form-group">
                        <label>{{ trans('shops.snap') }}</label>
                        <input type="text" class="form-control" id="snap" name="snap">
                    </div>

                    <div class="form-group">
                        <label>{{ trans('shops.web_site') }}</label>
                        <input type="text" class="form-control" id="web_site" name="web_site">
                    </div>


                    <div class="form-group">
                        <label>{{ trans('shops.shopType') }}</label>
                        <select class="form-control" name="shoptype_id">
                            <option disabled selected>{{ trans('shops.shopType') }}</option>
                            @foreach($shopType as $shopType)
                            <option value="{{$shopType->id}}">{{$shopType->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>{{ trans('shops.months') }}</label>
                        <input type="number" class="form-control" id="months" name="months">
                    </div>

                    {{-- <div class="form-group">
                        <label>{{ trans('shops.subscription_date') }}</label>
                        <input type="date" class="form-control" id="subscription_date" name="subscription_date"
                            value="{{ date('Y-m-d') }}">
                    </div> --}}

                    {{-- <div class="form-group">
                        <label>{{ trans('shops.expire_date') }}</label>
                        <input type="date" class="form-control" id="expire_date" name="expire_date"
                            value="{{ date('Y-m-d') }}">
                    </div> --}}

                    <div class="form-group">
                        <label>{{ trans('shops.category_name') }}</label>
                        <select class="form-control" name="category_id">
                            <option disabled selected>{{ trans('shops.category_name') }}</option>
                            @foreach($categories as $categories)
                            <option value="{{$categories->id}}">{{$categories->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>{{ trans('shops.packagetype') }}</label>
                        <select class="form-control" name="packagetype_id">
                            <option disabled selected>{{ trans('shops.packagetype') }}</option>
                            @foreach($packageType as $packageType)
                            <option value="{{$packageType->id}}">{{$packageType->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>{{ trans('shops.shop_description_ar') }}</label>

                                <textarea class="form-control" id="description" name="description"></textarea>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label>{{ trans('shops.shop_description_en') }}</label>
                                <textarea class="form-control" id="description_en" name="description_en"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>{{ trans('shops.profile_path') }}</label>
                        <input type="file" class="form-control" id="profile_path" name="profile_path">
                    </div>
                    <div class="form-group">
                        <label>{{ trans('shops.cover_path') }}</label>
                        <input type="file" class="form-control" id="cover_path" name="cover_path">
                    </div>


                </div>

                <div class="modal-footer">
                    <button type="submit" class="button x-small">{{ trans('shops.submit') }}</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('shops.close')
                        }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Basic modal -->
@endsection
@section('js')
{{-- <script src="{{ URL::asset('assets/plugins/select2.min.js') }}"></script> --}}
<script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script src="{{ asset('assets/plugins/js/select2.js') }}"></script>
<script src="{{ asset('assets/plugins/js/inputmask/jquery.inputmask.bundle.js') }}"></script>
<script src="{{ asset('assets/plugins/js/inputmask.js') }}"></script>
<script>
    $(document).ready(function() {
        $(".select2").select2();
        // $(".select3").select2();
        $('select[name="country_id"]').on('change', function() {
            console.log('jklh');
            var country_id = $(this).val();
            if (country_id) {
                $.ajax({
                    url: "{{ URL::to('country') }}/" + country_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('select[name="city_id[]"]').empty();

                        $.each(data.data, function(key, value) {
                            console.log(data);

                            $('select[name="city_id[]"]').append('<option value="' +
                                value["id"] + '">' + value["name"] + '</option>');
                        });
                    },
                });
            } else {
                console.log('AJAX load did not work');
            }
        });
    });
</script>

@toastr_js
@toastr_render

@endsection
