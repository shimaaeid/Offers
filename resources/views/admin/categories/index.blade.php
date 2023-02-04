@extends('layouts.master')
@section('css')

@toastr_css
@endsection

@section('title')
{{ trans('categories.title_page') }}
@stop

@section('page-header')
<!-- breadcrumb -->
<div class="page-title">

    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">{{ trans('main_sidebar.Category_list') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="default-color">{{
                        trans('main_sidebar.Dashboard') }}</a></li>
                <li class="breadcrumb-item active">{{ trans('categories.title_page') }}</li>
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
                {{-- @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif --}}
                <button type="button" class="button x-small" data-toggle="modal" data-effect="effect-scale"
                    href="#modaldemo1">{{ trans('categories.add') }}</button>
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered p-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>{{ trans('categories.name_category') }}</th>
                                <th>{{ trans('categories.image') }}</th>

                                <th>{{ trans('categories.operations') }}</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            @foreach ($categories as $categories)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $categories->name }}</td>
                                <td><img src="{{ asset($categories->image_path) }}" width="100px" height="100px"
                                        class="img-fluid"></td>

                                <td>
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                        data-target="#edit{{ $categories->id }}"
                                        title="{{ trans('categories.edit') }}"><i class="fa fa-edit"></i></button>

                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                        data-target="#delete{{ $categories->id }}"
                                        title="{{ trans('categories.delete') }}"><i class="fa fa-trash"></i></button>
                                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal"
                                        data-target="#image{{ $categories->id }}"
                                        title="{{ trans('categories.image') }}"><i class="fa fa-image"></i></button>

                                </td>
                            </tr>


                            <!-- Basic modal Edit -->
                            <div class="modal fade" id="edit{{ $categories->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                {{ trans('categories.edit') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- add_form -->
                                            <form action="{{ route('categories.update', 'test') }}" method="post">
                                                {{ method_field('patch') }}
                                                @csrf
                                                <div class="row">
                                                    <div class="col">
                                                        <input id="id" type="hidden" name="id" class="form-control"
                                                            value="{{ $categories->id }}">
                                                        <label for="Name" class="mr-sm-2">{{
                                                            trans('categories.category_name_ar') }}
                                                            :</label>
                                                        <input id="name" type="text" name="name" class="form-control"
                                                            value="{{ $categories->getTranslation('name', 'ar') }}"
                                                            >
                                                        @if ($errors->has('name'))
                                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                                        @endif

                                                    </div>
                                                    <div class="col">
                                                        <label for="Name_en" class="mr-sm-2">{{
                                                            trans('categories.category_name_en') }}
                                                            :</label>
                                                        <input type="text" class="form-control"
                                                            value="{{ $categories->getTranslation('name', 'en') }}"
                                                            name="name_en" >
                                                        @if ($errors->has('name_en'))
                                                        <span class="text-danger">{{ $errors->first('name_en') }}</span>
                                                        @endif
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

                            <!-- Basic modal Edit image-->
                            <div class="modal fade" id="image{{ $categories->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                {{ trans('categories.image') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- add_form -->
                                            <form action="{{ route('updateImage') }}" method="post"
                                                enctype="multipart/form-data">
                                                {{ method_field('POST') }}
                                                @csrf
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="Image" class="mr-sm-2">{{trans('categories.image')
                                                            }}
                                                            :</label>
                                                        <input id="id" type="hidden" name="id" class="form-control"
                                                            value="{{ $categories->id }}">

                                                        <input type="file" id="image_path" name="image_path"
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

                            <!-- delete categories -->
                            <div class="modal fade" id="delete{{ $categories->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                {{ trans('categories.delete') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{route('categories.destroy', 'test')}}" method="post">
                                                {{method_field('Delete')}}
                                                @csrf
                                                {{ trans('categories.warning_category') }}
                                                <input id="id" type="hidden" name="id" class="form-control"
                                                    value="{{ $categories->id }}">
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">{{ trans('categories.close') }}</button>
                                                    <button type="submit" class="btn btn-danger">{{
                                                        trans('categories.submit') }}</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end categories -->
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
                <h6 class="modal-title">{{ trans('categories.add_category') }}</h6><button aria-label="Close"
                    class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>{{ trans('categories.category_name_ar') }}</label>

                        <input type="text" class="form-control" id="name" name="name">
                    </div>

                    <div class="form-group">
                        <label>{{ trans('categories.category_name_en') }}</label>
                        <input type="text" class="form-control" id="name_en" name="name_en">
                    </div>

                    <div class="form-group">
                        <label>{{ trans('categories.image') }}</label>
                        <input type="file" class="form-control" id="image_path" name="image_path">
                    </div>


                </div>

                <div class="modal-footer">
                    <button type="submit" class="button x-small">{{ trans('categories.submit') }}</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('categories.close')
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
