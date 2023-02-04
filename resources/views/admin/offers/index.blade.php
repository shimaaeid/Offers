@extends('layouts.master')
@section('css')

@toastr_css
@endsection

@section('title')
{{ trans('offers.title_page') }}
@stop

@section('page-header')
<!-- breadcrumb -->
<div class="page-title">

    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">{{ trans('main_sidebar.Offer_list') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="default-color">{{ trans('main_sidebar.Dashboard') }}</a></li>
                <li class="breadcrumb-item active">{{ trans('offers.title_page') }}</li>
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
                <button type="button" class="button x-small" data-toggle="modal" data-effect="effect-scale" href="#modaldemo1">{{ trans('offers.add') }}</button>
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered p-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>{{ trans('offers.shop_name') }}</th>
                                <th>{{ trans('offers.category_name') }}</th>
                                <th>{{ trans('offers.offer_title') }}</th>
                                <th>{{ trans('offers.offer_description') }}</th>
                                <th>{{ trans('offers.price') }}</th>
                                <th>{{ trans('offers.discount') }}</th>
                                <th>{{ trans('offers.image_path') }}</th>
                                <th>{{ trans('offers.deadline') }}</th>
                                <th>{{ trans('offers.likes') }}</th>
                                <th>{{ trans('offers.operations') }}</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            @foreach ($offers as $offers)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $offers->shop->name }}</td>
                                <td>{{ $offers->category->name }}</td>
                                <td>{{ $offers->title}}</td>
                                <td>{{ $offers->description}}</td>
                                <td>{{ $offers->price}}</td>
                                <td>{{ $offers->discount}}</td>
                                <td><img src="{{ asset($offers->image_path) }}" width="100px" height="100px" class="img-fluid"></td>
                                <td>{{ $offers->deadline}}</td>
                                <td>{{ $offers->likes}}</td>
                                
                                <td>
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit{{ $offers->id }}" title="{{ trans('offers.edit') }}"><i class="fa fa-edit"></i></button>

                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete{{ $offers->id }}" title="{{ trans('offers.delete') }}"><i class="fa fa-trash"></i></button>

                                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#image{{ $offers->id }}"  title="{{ trans('offers.image_path') }}"><i class="fa fa-image"></i></button>

                                </td>
                            </tr>

                              <!-- Basic modal Edit flag-->
                              <div class="modal fade" id="image{{ $offers->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                                                {{ trans('offers.image_path') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- add_form -->
                                            <form action="{{ route('updateOfferImage') }}" method="post" enctype="multipart/form-data">
                                                {{ method_field('POST') }}
                                                @csrf
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="Image" class="mr-sm-2">{{trans('offers.image_path') }}
                                                            :</label>
                                                            <input id="id" type="hidden" name="id" class="form-control" value="{{ $offers->id }}">

                                                        <input type="file" id="image_path"  name="image_path" class="form-control" required>
                                                    </div>
                                                   
                                                </div>
                                            
                                                <br><br>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('countries.close') }}</button>
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
                            <div class="modal fade" id="edit{{ $offers->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                                                {{ trans('offers.edit') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- add_form -->
                                            <form action="{{ route('offers.update', 'test') }}" method="post">
                                                {{ method_field('patch') }}
                                                @csrf
                                               
                                    
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <input type="hidden" class="form-control" id="id" name="id" value="{{ $offers->id }}">

                                                        <label>{{ trans('offers.shop_name') }}</label>
                                                        <select class="form-control" name="shop_id">
                                                            <option disabled selected>{{ trans('offers.select_shop_name') }}</option>
                                                            @foreach($shops as $xx)
                                                            @if($xx->id == $offers->shop->id)
                                                            <option value="{{$xx->id}}" selected>{{$xx->name}}</option>
                                                            @else
                                                            <option value="{{$xx->id}}">{{$xx->name}}</option>
                                                            @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                
                                                    <div class="form-group">
                                                        <label>{{ trans('offers.category_name') }}</label>
                                                        <select class="form-control" name="category_id">
                                                            <option disabled selected>{{ trans('offers.select_category_name') }}</option>
                                                            @foreach($categories as $categoryx)
                                                            @if($categoryx->id == $offers->category->id)
                                                            <option value="{{$categoryx->id}}" selected>{{$categoryx->name}}</option>
                                                            @else
                                                            <option value="{{$categoryx->id}}">{{$categoryx->name}}</option>
                                                            @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label>{{ trans('offers.offer_title_ar') }}</label>
                                        
                                                                <input type="text" class="form-control" id="title" name="title" value="{{ $offers->getTranslation('title', 'ar') }}">
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label>{{ trans('offers.offer_title_en') }}</label>
                                                                <input type="text" class="form-control" id="title_en" name="title_en" value="{{ $offers->getTranslation('title', 'en') }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label>{{ trans('offers.offer_description_ar') }}</label>
                                        
                                                                <textarea class="form-control" id="description" name="description">{{ $offers->getTranslation('description', 'ar') }}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label>{{ trans('offers.offer_description_en') }}</label>
                                                                <textarea class="form-control" id="description_en" name="description_en">{{ $offers->getTranslation('description', 'en') }}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                
                                                    <div class="form-group">
                                                        <label>{{ trans('offers.price') }}</label>
                                                        <input type="number" class="form-control" id="price" name="price" value="{{ $offers->price }}">
                                                    </div>
                                
                                                    <div class="form-group">
                                                        <label>{{ trans('offers.discount') }}</label>
                                                        <input type="number" class="form-control" id="discount" name="discount" value="{{ $offers->discount }}">
                                                    </div>
                                
                                                    {{-- <div class="form-group">
                                                        <label>{{ trans('offers.image') }}</label>
                                                        <input type="file" class="form-control" id="image_path" name="image_path">
                                                    </div> --}}
                                
                                                    <div class="form-group">
                                                        <label>{{ trans('offers.deadline') }}</label>
                                                        <input type="datetime-local" class="form-control" id="deadline" name="deadline" value="{{ $offers->deadline }}">
                                                    </div>
                                
                                                    {{-- <div class="form-group">
                                                        <label>{{ trans('offers.likes') }}</label>
                                                        <input type="number" class="form-control" id="likes" name="likes">
                                                    </div> --}}
                                
                                                    
                                                </div>

                                                <br><br>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('offers.close') }}</button>
                                                    <button type="submit" class="btn btn-success">{{
                                                        trans('offers.submit') }}</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Basic modal -->

                            <!-- delete categories -->
                            <div class="modal fade" id="delete{{ $offers->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                                                {{ trans('offers.delete') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{route('offers.destroy', 'test')}}" method="post">
                                                {{method_field('Delete')}}
                                                @csrf
                                                {{ trans('offers.warning_offer') }}
                                                <input id="id" type="hidden" name="id" class="form-control" value="{{ $offers->id }}">
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('offers.close') }}</button>
                                                    <button type="submit" class="btn btn-danger">{{ trans('offers.submit') }}</button>
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
                <h6 class="modal-title">{{ trans('offers.add_offer') }}</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{ route('offers.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>{{ trans('offers.shop_name') }}</label>
                        <select class="form-control" name="shop_id">
                            <option disabled selected>{{ trans('offers.select_shop_name') }}</option>
                            @foreach($shops as $shop)
                            <option value="{{$shop->id}}">{{$shop->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>{{ trans('offers.category_name') }}</label>
                        <select class="form-control" name="category_id">
                            <option disabled selected>{{ trans('offers.select_category_name') }}</option>
                            @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>{{ trans('offers.offer_title_ar') }}</label>
        
                                <input type="text" class="form-control" id="title" name="title">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label>{{ trans('offers.offer_title_en') }}</label>
                                <input type="text" class="form-control" id="title_en" name="title_en">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>{{ trans('offers.offer_description_ar') }}</label>
        
                                <textarea class="form-control" id="description" name="description"></textarea>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label>{{ trans('offers.offer_description_en') }}</label>
                                <textarea class="form-control" id="description_en" name="description_en"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>{{ trans('offers.price') }}</label>
                        <input type="number" class="form-control" id="price" name="price">
                    </div>

                    <div class="form-group">
                        <label>{{ trans('offers.discount') }}</label>
                        <input type="number" class="form-control" id="discount" name="discount">
                    </div>

                    <div class="form-group">
                        <label>{{ trans('offers.image') }}</label>
                        <input type="file" class="form-control" id="image_path" name="image_path">
                    </div>

                    <div class="form-group">
                        <label>{{ trans('offers.deadline') }}</label>
                        <input type="datetime-local" class="form-control" id="deadline" name="deadline">
                    </div>

                    {{-- <div class="form-group">
                        <label>{{ trans('offers.likes') }}</label>
                        <input type="number" class="form-control" id="likes" name="likes">
                    </div> --}}

                    
                </div>

                <div class="modal-footer">
                    <button type="submit" class="button x-small">{{ trans('offers.submit') }}</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('offers.close')
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
