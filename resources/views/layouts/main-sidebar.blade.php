<div class="container-fluid">
    <div class="row">
        <!-- Left Sidebar start-->
        <div class="side-menu-fixed">
            <div class="scrollbar side-menu-bg">
                <ul class="nav navbar-nav side-menu" id="sidebarnav">
                    <!-- menu item Dashboard-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#dashboard">
                            <div class="pull-left"><i class="ti-home"></i><span class="right-nav-text">{{
                                    trans('main_sidebar.Dashboard') }}</span>
                            </div>
                            {{-- <div class="pull-right"><i class="ti-plus"></i></div> --}}
                            <div class="clearfix"></div>
                        </a>
                        {{-- <ul id="dashboard" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="index.html">Dashboard 01</a> </li>
                            <li> <a href="index-02.html">Dashboard 02</a> </li>
                            <li> <a href="index-03.html">Dashboard 03</a> </li>
                            <li> <a href="index-04.html">Dashboard 04</a> </li>
                            <li> <a href="index-05.html">Dashboard 05</a> </li>
                        </ul> --}}
                    </li>
                    <!-- menu title -->
                    <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">Components </li>
                    <!-- menu item Elements-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#elements">
                            <div class="pull-left"><i class="ti-palette"></i><span class="right-nav-text">{{
                                    trans('main_sidebar.Country_list') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="elements" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{ route('countries.index') }}">{{ trans('main_sidebar.Country_list') }}</a>
                            </li>
                        </ul>
                    </li>
                    <!-- menu item calendar-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#calendar-menu">
                            <div class="pull-left"><i class="ti-calendar"></i><span class="right-nav-text">{{
                                    trans('main_sidebar.City_list') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="calendar-menu" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{ route('cities.index') }}">{{ trans('main_sidebar.City_list') }}</a> </li>
                        </ul>
                    </li>
                    <!-- menu item todo-->
                    <li>
                        <a href="{{ route('categories.index') }}"><i class="ti-menu-alt"></i><span
                                class="right-nav-text">{{ trans('main_sidebar.Category_list') }}</span> </a>
                    </li>
                    <!-- menu item chat-->
                    <li>
                        <a href="{{ route('shops.index') }}"><i class="ti-comments"></i><span class="right-nav-text">{{
                                trans('main_sidebar.Shop_list') }}</span></a>
                    </li>
                    <!-- menu item mailbox-->
                    <li>
                        <a href="{{ route('offers.index') }}"><i class="ti-email"></i><span class="right-nav-text">{{
                                trans('main_sidebar.Offer_list') }}</span></a>
                    </li>
                    <!-- menu item Charts-->
                    <li>
                        <a href="{{ route('best-offers.index') }}"><i class="ti-email"></i><span
                                class="right-nav-text">{{ trans('main_sidebar.BestOffer_list') }}</span> <span
                                class="badge badge-pill badge-warning float-right mt-1">HOT</span> </a>
                    </li>

                    <li>
                        <a href="{{ route('shop-watches.index') }}"><i class="fa fa-laptop-code"></i><span
                                class="right-nav-text">{{ trans('main_sidebar.shopWatches_list') }}</span> </a>
                    </li>

                    <li>
                        <a href="{{ route('offer-likes.index') }}"><i class="fa fa-laptop-code"></i><span
                                class="right-nav-text">{{ trans('main_sidebar.Likes_list') }}</span> </a>
                    </li>

                    <li>
                        <a href="{{ route('settings.index') }}"><i class="fa fa-laptop-code"></i><span
                                class="right-nav-text">{{ trans('main_sidebar.setting') }}</span> </a>
                    </li>




                </ul>
            </div>
        </div>

        <!-- Left Sidebar End-->

        <!--=================================
