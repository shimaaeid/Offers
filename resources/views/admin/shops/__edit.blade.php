@extends('layouts.master')
@section('css')

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
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="default-color">{{ trans('main_sidebar.Dashboard') }}</a></li>
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
               
                    <!-- Basic modal Edit -->
                    
                            <div class="modal-content">
                                
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
                                                        <input type="text" class="form-control" id="name" name="name" value="{{ $shops->getTranslation('name', 'ar') }}">
                                                    </div>
                                                </div>
                        
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label>{{ trans('shops.shop_name_en') }}</label>
                                                        <input type="text" class="form-control" id="name_en" name="name_en" value="{{ $shops->getTranslation('name', 'en') }}">
                                                    </div>
                                                </div>
                                            </div>
                                           
                                            <div class="form-group">
                                                <label>{{ trans('shops.email') }}</label>
                                                <input type="email" class="form-control" id="email" name="email" value="{{ $shops->email }}">
                                            </div>
                        
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label>{{ trans('shops.password') }}</label>
                                                        <input type="password" class="form-control" id="password" name="password" value="{{ $shops->password }}">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label>{{ trans('shops.password_confirmation') }}</label>
                                                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                                                    </div>
                        
                                                </div>
                                            </div>
                        
                                           
                        
                                            <div class="form-group">
                                                <label>{{ trans('shops.phone') }}</label>
                                                <input type="text" class="form-control" id="phone" name="phone" value="{{ $shops->phone }}">
                                            </div>
                        
                        
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label>{{ trans('shops.shop_opening_hours_ar') }}</label>
                                
                                                        <input type="text" class="form-control" id="opening_hours" name="opening_hours" value="{{ $shops->getTranslation('opening_hours', 'ar') }}">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label>{{ trans('shops.shop_opening_hours_en') }}</label>
                                                        <input type="text" class="form-control" id="opening_hours_en" name="opening_hours_en" value="{{ $shops->getTranslation('opening_hours', 'en') }}">
                                                    </div>
                        
                                                </div>
                                            </div>
                        
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label>{{ trans('shops.country_name') }}</label>
                                                        <select name="country_id" class="form-control SlectBox" 
                                                        onclick="console.log($(this).val())" onclick="console.log('change is firing')" multiple>
                                                            <!--placeholder-->
                                                            {{-- <option value="" selected disabled>{{ trans('shops.country_name') }}</option> --}}
                                                            @foreach ($countries as $countriest)
                                                            @if($countriest->id ==  $shops->cities->first()->country->id)
                                                            
                                                                <option value="{{ $countriest->id }}" selected> {{ $countriest->name }}</option>
                                                                @else
                                                                <option value="{{ $countriest->id }}" > {{ $countriest->name }}</option>
                                                                @endif

                                                            @endforeach
                                                        </select>
                                                        
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="inputName" class="control-label">{{ trans('shops.cities_name') }}</label>
                                                        <select id="city_id[]" name="city_id[]" class="form-control" multiple="multiple">
                                                        </select>
                                                    </div>
                        
                                                </div>
                                            </div>
                        
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label>{{ trans('shops.shop_location_ar') }}</label>
                                
                                                        <input type="text" class="form-control" id="location" name="location" value="{{ $shops->getTranslation('location', 'ar') }}">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label>{{ trans('shops.shop_location_en') }}</label>
                                                        <input type="text" class="form-control" id="location_en" name="location_en" value="{{ $shops->getTranslation('location', 'en') }}">
                                                    </div>
                                                </div>
                                            </div>
                        
                                            <div class="form-group">
                                                <label>{{ trans('shops.location_url') }}</label>
                                                <input type="text" class="form-control" id="location_url" name="location_url" value="{{ $shops->location_url }}">
                                            </div>
                        
                                            <div class="form-group">
                                                <label>{{ trans('shops.whatsapp') }}</label>
                                                <input type="text" class="form-control" id="whatsapp" name="whatsapp" value="{{ $shops->whatsapp }}">
                                            </div>
                        
                                            <div class="form-group">
                                                <label>{{ trans('shops.insta') }}</label>
                                                <input type="text" class="form-control" id="insta" name="insta" value="{{ $shops->insta }}">
                                            </div>
                        
                                            <div class="form-group">
                                                <label>{{ trans('shops.snap') }}</label>
                                                <input type="text" class="form-control" id="snap" name="snap" value="{{ $shops->snap }}">
                                            </div>
                        
                                            <div class="form-group">
                                                <label>{{ trans('shops.web_site') }}</label>
                                                <input type="text" class="form-control" id="web_site" name="web_site" value="{{ $shops->web_site }}">
                                            </div>
                        
                        
                                            <div class="form-group">
                                                <label>{{ trans('shops.shopType') }}</label>
                                                <select class="form-control" name="shoptype_id">
                                                    <option disabled selected>{{ trans('shops.shopType') }}</option>
                                                    @foreach($shopType as $shoptest)
                                                    @if ($shoptest->id == $shops->shopType->id)
                                                    <option value="{{$shoptest->id}}" selected>{{$shoptest->name}}</option>
                                                    @else
                                                    <option value="{{$shoptest->id}}">{{$shoptest->name}}</option>
                                                        
                                                    @endif
                                                    
                                                    @endforeach
                                                </select>
                                            </div>
                        
                                            <div class="form-group">
                                                <label>{{ trans('shops.months') }}</label>
                                                <input type="number" class="form-control" id="months" name="months" value="{{ $shops->months }}">
                                            </div>
                        
                                            <div class="form-group">
                                                <label>{{ trans('shops.category_name') }}</label>
                                                <select class="form-control" name="category_id">
                                                    <option disabled selected>{{ trans('shops.category_name') }}</option>
                                                    @foreach($categories as $categoryTest)
                                                    @if($categoryTest->id == $shops->category->id)
                                                    <option value="{{$categoryTest->id}}" selected>{{$categoryTest->name}}</option>
                                                    @else
                                                    <option value="{{$categoryTest->id}}">{{$categoryTest->name}}</option>
                                                    @endif
                                                    @endforeach
                                                </select>
                                            </div>
                        
                                            <div class="form-group">
                                                <label>{{ trans('shops.packagetype') }}</label>
                                                <select class="form-control" name="packagetype_id">
                                                    <option disabled selected>{{ trans('shops.packagetype') }}</option>
                                                    @foreach($packageType as $packageTest)
                                                    @if($packageTest->id == $shops->packageType->id)
                                                    <option value="{{$packageTest->id}}" selected>{{$packageTest->name}}</option>
                                                    @else
                                                    <option value="{{$packageTest->id}}" >{{$packageTest->name}}</option>
                                                    @endif

                                                    @endforeach
                                                </select>
                                            </div>
                        
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label>{{ trans('shops.shop_description_ar') }}</label>
                                
                                                        <textarea class="form-control" id="description" name="description">{{ $shops->getTranslation('description', 'ar') }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label>{{ trans('shops.shop_description_en') }}</label>
                                                        <textarea class="form-control" id="description_en" name="description_en">{{ $shops->getTranslation('description', 'en') }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                        
                                          
                        
                                            
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('shops.close') }}</button>
                                            <button type="submit" class="btn btn-success">{{
                                                trans('shops.submit') }}</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                       
                    <!-- End Basic modal -->
                </div>
            </div>
        </div>
    </div>


</div>

@endsection
@section('js')
{{-- <script src="{{ URL::asset('assets/plugins/select2.min.js') }}"></script> --}}
<script>
    $(document).ready(function() {
        $('select[name="country_id"]').on('click', function() {
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
