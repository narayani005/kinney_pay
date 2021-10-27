<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>@yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta content="Kinney Pay Wallet" name="Wallet" />
        <meta content="Themesbrand" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('assets/images/kinney.ico') }}" />
        <!-- DataTables -->
        <link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

        <!-- Responsive datatable examples -->
        <link href="{{ asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

        <!-- Bootstrap Css -->
        <link href="{{ asset('assets/css/bootstrap.min.css') }} " id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{ asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
        <!-- IntlTel -->
        <link href="{{ asset('assets/css/intlTelInput.css')}}" id="int-style" rel="stylesheet" type="text/css" />

        <!-- Plans -->
        <link href="{{ asset('assets/css/plans.css')}}" id="plan-style" rel="stylesheet" type="text/css" />

        <!-- Datatables CSS CDN -->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" />
        
       
    </head>
    <style>
        body {
            font-family: system-ui;
        }

        #page-topbar {
            background: rgb(89,153,208);
            background-image: linear-gradient(to left bottom, #677084, #626e8a, #5c6c90, #576a95, #51689b) !important;
        }

        .page-title-box {
            background: rgb(89,153,208);
            background-image: linear-gradient(to left bottom, #677084, #626e8a, #5c6c90, #576a95, #51689b) !important;
        }

        .bg-primary {
            background-color: rgb(69 90 138) !important;
        }

        .btn-primary {
            color: #fff;
            background-color: #5b6b92 !important;
            border-color: #5b6b92 !important;
        }

        .mm-active {
            color: #ffffff !important;
        }

        .mm-active > a {
            color: #ffff !important;
            background-color: unset !important;
        }

        .mm-active .active i {
            color: #ffffff !important;
            background-color: unset !important;
        }

        #sidebar-menu ul li a {
            font-family: system-ui !important;
        }

        #sidebar-menu ul li a i {
            font-size: 20px !important;
            line-height: 40px !important;
        }

        .mdi-set,
        .mdi:before {
            color: currentColor !important;
        }

        a.has-arrow.waves-effect.mm-active {
            background: rgb(89,153,208);
            background-image: linear-gradient(to left bottom, #677084, #626e8a, #5c6c90, #576a95, #51689b) !important;
        }

        a.waves-effect.active {
            background: rgb(89,153,208);
            background-image: linear-gradient(to left bottom, #677084, #626e8a, #5c6c90, #576a95, #51689b) !important;
        }

        .vertical-menu {
            background: rgb(89,153,208);
            background-image: linear-gradient(to left bottom, #677084, #626e8a, #5c6c90, #576a95, #51689b) !important;
        }

        .menu-title {
            padding: 12px 20px !important;
            color: #ccd0da !important;
            font-weight: 700 !important;
        }

        body[data-topbar="colored"] .navbar-brand-box {
            background-color: #122a49 !important;
        }

        .fa-2x {
            font-size: 2em;
            color: #3c5d7b;
        }

        .form-check-input:checked {
            background-color: #b73d3d;
            border-color: #463939;
            background: rgb(89,153,208);
            background-image: linear-gradient(to left bottom, #677084, #626e8a, #5c6c90, #576a95, #51689b) !important;
        }

        .form-select:focus {
            border-color: #5496cd !importants;
            outline: 0;
            -webkit-box-shadow: 0 0 0 0.15rem rgb(85 150 206) !important;
            box-shadow: 0 0 0 0.15rem rgb(86 151 206) !important;
        }

        a {
            color: white !important;
        }

        .dropdown-menu.dropdown-menu-end.show {
            background: rgb(89,153,208);
            background-image: linear-gradient(to left bottom, #677084, #626e8a, #5c6c90, #576a95, #51689b) !important;
        }

        body[data-topbar="colored"] .navbar-header .dropdown .show.header-item {
            background-color: #4b6f8c !important;
        }

        .dropdown-item:focus,
        .dropdown-item:hover {
            background-color: #4b6f8c !important;
        }

        body[data-topbar="colored"] .navbar-brand-box {
            background: rgb(89,153,208);
            background-image: linear-gradient(to left bottom, #677084, #626e8a, #5c6c90, #576a95, #51689b) !important;
        }

        .breadcrumb-item+.breadcrumb-item::before {
            color: #e9e9ef !important;
        }

        .breadcrumb-item.active {
            color: #ffffff !important;
        }

        /* Rewards Banner silder */

        .img-thumbnail {
            padding: .25rem;
            background-color: unset !important;
            border: none !important;
            border-radius: .25rem;
            max-width: 100%;
            height: auto;
        }
        .pricing-table .ptable-description ul {
            font-family: system-ui;
        }

        .pricing-table .ptable-single {
            background: none !important;
        }

        .bg-card-primary {
            background: linear-gradient(to left, #274046, #e46262) !important;
        }

        .btn-danger-view {
            color: #fff;
            background-color: #d65f60;
            border-color: #000000;
        }

        /* End */

        .wrapper {
            padding: 4em;
            padding-bottom: 0;
        }

        .currency-selector {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            padding-left: 0.5rem;
            border: 0;
            background: transparent;

            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;

            background: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='1024' height='640'><path d='M1017 68L541 626q-11 12-26 12t-26-12L13 68Q-3 49 6 24.5T39 0h952q24 0 33 24.5t-7 43.5z'></path></svg>") 90%/12px
                6px no-repeat;

            font-family: inherit;
            color: inherit;
        }

        .currency-amount {
            text-align: right;
        }

        .currency-addon {
            width: 6em;
            text-align: left;
            position: relative;
        }
       .googlepay{
        margin: 20px 10px !important;
        background: #3780BD;
        
       }
       .app{
        margin: 20px 3px !important;
      
       }

       #generic_price_table .generic_content:hover .generic_price_btn a, #generic_price_table .generic_content.active .generic_price_btn a {
            background-color: #616e8c !important;
            color: #fff;
        }

        #generic_price_table .generic_content.active .generic_head_price .generic_head_content .head_bg, #generic_price_table .generic_content:hover .generic_head_price .generic_head_content .head_bg {
            border-color: #53728c rgba(0, 0, 0, 0) rgba(0, 0, 0, 0) #616e8c !important;
            color: #fff;
        }
               
        #generic_price_table .generic_content .generic_feature_list ul li:hover {
        background-color: #E4E4E4 !important;
        border-left: 5px solid #e64a1d;
        }

        #generic_price_table .generic_content .generic_price_btn a {
            border: 2px solid #777777 !important;
        }
     
        #generic_price_table {
            background-color: #ffffff !important;
        }

        #generic_price_table .generic_content .generic_feature_list ul li:hover {
            border-left: 5px solid #616e8c !important;
        }
        .footer {
        height: 100px !important;
        }
    </style>
    <body data-topbar="colored">
        <!-- <body data-layout="horizontal" data-topbar="colored"> -->

        <!-- Begin page -->
        <div id="layout-wrapper">
            <header id="page-topbar">
                <div class="navbar-header">
                    <div class="d-flex">
                        <!-- LOGO -->
                        <div class="navbar-brand-box" >
                            <a href="{{ url('/home') }}" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="{{ asset('assets/images/kinney_logo.png') }}" alt="" height="70px" width="180px" />
                                </span>
                                <span class="logo-lg">
                                    <img src="{{ asset('assets/images/kinney_logo.png')}}" alt="" height="70px" width="180px" />
                                </span>
                            </a>

                            <a href="{{ url('/home') }}" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="{{ asset('assets/images/kinney_logo.png') }}" alt="" height="70px" width="180px" />
                                </span>
                                <span class="logo-lg">
                                    <img src="{{ asset('assets/images/kinney_logo.png') }}" alt="" height="70px" width="180px" />
                                </span>
                            </a>
                        </div>

                        <!-- Menu Icon -->

                        <button type="button" class="btn px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
                            <i class="mdi mdi-menu"></i>
                        </button>
                    </div>

                    <div class="d-flex">
                        <div class="dropdown d-inline-block d-lg-none ms-2">
                            <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="mdi mdi-magnify"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-search-dropdown">
                                <form class="p-3">
                                    <div class="form-group m-0">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username" />
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        
                        <!-- App Search -->
<!--                         <form class="app-search d-none d-lg-block">
                            <div class="position-relative">
                                <input type="text" class="form-control" placeholder="Search..." />
                                <span class="mdi mdi-magnify"></span>
                            </div>
                        </form> -->

                        <!-- Notification Dropdown -->
                        <!-- <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="mdi mdi-bell"></i>
                                <span class="badge bg-info rounded-pill">3</span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-notifications-dropdown">
                                <h5 class="p-3 text-dark mb-0">Notifications (37)</h5>
                                <div data-simplebar style="max-height: 230px;">
                                    <a href="" class="text-reset notification-item">
                                        <div class="d-flex mt-3">
                                            <div class="avatar-xs me-3">
                                                <span class="avatar-title bg-success rounded-circle font-size-16">
                                                    <i class="mdi mdi-cart"></i>
                                                </span>
                                            </div>
                                            <div class="flex-1">
                                                <h6 class="mb-1">Your order is placed</h6>
                                                <div class="font-size-12 text-muted">
                                                    <p class="mb-1">If several languages coalesce the grammar</p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>

                                    <a href="" class="text-reset notification-item">
                                        <div class="d-flex mt-3">
                                            <div class="avatar-xs me-3">
                                                <span class="avatar-title bg-warning rounded-circle font-size-16">
                                                    <i class="mdi mdi-message"></i>
                                                </span>
                                            </div>
                                            <div class="flex-1">
                                                <h6 class="mb-1">New Massage received</h6>
                                                <div class="font-size-12 text-muted">
                                                    <p class="mb-1">You have 87 unread message</p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>

                                    <a href="" class="text-reset notification-item">
                                        <div class="d-flex mt-3">
                                            <div class="avatar-xs me-3">
                                                <span class="avatar-title bg-info rounded-circle font-size-16">
                                                    <i class="mdi mdi-flag"></i>
                                                </span>
                                            </div>
                                            <div class="flex-1">
                                                <h6 class="mb-1">Your item is shipped</h6>
                                                <div class="font-size-12 text-muted">
                                                    <p class="mb-1">If several languages coalesce the grammar</p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="" class="text-reset notification-item">
                                        <div class="d-flex mt-3">
                                            <div class="avatar-xs me-3">
                                                <span class="avatar-title bg-primary rounded-circle font-size-16">
                                                    <i class="mdi mdi-cart"></i>
                                                </span>
                                            </div>
                                            <div class="flex-1">
                                                <h6 class="mb-1">Your Order is placed</h6>
                                                <div class="font-size-12 text-muted">
                                                    <p class="mb-1">It will seem like simplified English</p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>

                                    <a href="" class="text-reset notification-item">
                                        <div class="d-flex mt-3">
                                            <div class="avatar-xs me-3">
                                                <span class="avatar-title bg-danger rounded-circle font-size-16">
                                                    <i class="mdi mdi-message"></i>
                                                </span>
                                            </div>
                                            <div class="flex-1">
                                                <h6 class="mb-1">New Massage received</h6>
                                                <div class="font-size-12 text-muted">
                                                    <p class="mb-1">You have 87 unread message</p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="p-2 d-grid">
                                    <a class="font-size-14 text-center" href="javascript:void(0)">View all</a>
                                </div>
                            </div>
                        </div> -->

                        <!-- User -->
                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="rounded-circle header-profile-user" src="{{ URL::to('/images/profile/' .auth()->user()->profile_img.'') }}" alt="{{ auth()->user()->profile_img }}" />
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <a class="dropdown-item" href="{{ url('/Profile') }}"><i class="mdi mdi-account-circle font-size-16 align-middle me-2 text-white"></i> <span>Profile</span></a>
                                <a class="dropdown-item" href="{{ url('/Transaction-History') }}"><i class="mdi mdi-wallet font-size-16 align-middle text-white me-2"></i> <span>My Wallet</span></a>
                                <a class="dropdown-item d-block" href="#"><span class="badge bg-success float-end">11</span><i class="mdi mdi-wrench font-size-16 align-middle text-white me-2"></i> <span>Settings</span></a>

                                <!-- <a class="dropdown-item" href="#"><i class="mdi mdi-lock-open-outline font-size-16 text-muted align-middle me-2"></i> <span>Lock screen</span></a> -->
                                
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-white" onclick="return confirm('Really want to Logout?')" href="{{ url('/logout') }}"><i class="mdi mdi-power font-size-16 align-middle me-2 text-white"></i> <span>Logout</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- ========== Left Sidebar Start ========== -->
            <div class="vertical-menu">
                <div data-simplebar class="h-100">
                    <div class="user-details">
                        <div class="d-flex">
                            <div class="me-2">
                                <img src="{{ asset('assets/images/users/avatar-4.jpg') }}" alt="" class="avatar-md rounded-circle" />
                            </div>
                            <div class="user-info w-100">
                                <div class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Donald Johnson
                                        <i class="mdi mdi-chevron-down"></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="javascript:void(0)" class="dropdown-item">
                                                <i class="mdi mdi-account-circle text-muted me-2"></i> Profile
                                                <div class="ripple-wrapper me-2"></div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)" class="dropdown-item"><i class="mdi mdi-cog text-muted me-2"></i> Settings</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)" class="dropdown-item"><i class="mdi mdi-lock-open-outline text-muted me-2"></i> Lock screen</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)" class="dropdown-item"><i class="mdi mdi-power text-muted me-2"></i> Logout</a>
                                        </li>
                                    </ul>
                                </div>

                                <p class="text-white-50 m-0">Administrator</p>
                            </div>
                        </div>
                    </div>

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <!-- Left Menu Start -->
                        <ul class="metismenu list-unstyled" id="side-menu">
                            <li class="menu-title"></li>

                            <!-- <li class="menu-title text-uppercase">Dashboard</li> -->
                            <li>
                                <a href="{{ url('/home') }}" class="waves-effect">
                                    <i class="mdi mdi-home fa-2x" style="color: white !important;"></i>
                                    <span>Dashboard</span>
                                </a>
                            </li>
                            @if(!auth()->user()->is_admin)
                            <!-- <li class="menu-title text-uppercase">Beneficiary List</li> -->
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="mdi mdi-account-multiple-plus" style="color: white !important;"></i>
                                    <span>Beneficiary</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li>
                                        <a href="{{ url('/create-beneficiary') }}"><i class="mdi mdi-open-in-new" style="color: white !important;"></i>Add Beneficiary</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/beneficiary-index') }}"><i class="mdi mdi-view-list" style="color: white !important;"></i>List of Beneficiary</a>
                                    </li>
                                </ul>
                            </li>
                            @endif
                            @if(auth()->user()->is_admin)
                            <li class="menu-title text-uppercase">Users</li>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="mdi mdi-account-multiple" style="color: white !important;"></i>
                                    <span>All Users</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li>
                                        <a href="{{ url('/admin/add_user') }}"><i class="mdi mdi-account-plus" style="color: white !important;"></i>Add User</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/admin/users') }}"><i class="mdi mdi-history" style="color: white !important;"></i>Users History</a>
                                    </li>
                                </ul>
                            </li>

                            @endif
                            @if(!auth()->user()->is_admin)
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="mdi mdi-wallet" style="color: white !important;"></i>
                                    <span>My Wallet</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li>
                                        <a href="{{ url('/Add-Wallet') }}"><i class="mdi mdi-account-circle" style="color: white !important;"></i> Self Transfer</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/Bank-Accounts') }}"><i class="mdi mdi-bank" style="color: white !important;"></i> Bank Accounts</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/Share-Wallet') }}"><i class="mdi mdi-cash-multiple" style="color: white !important;"></i> Send Money </a>
                                    </li>
                                    
                                    <li>
                                        <a href="{{ url('/req-money') }}"><i class="mdi mdi-cash-multiple" style="color: white !important;"></i> Withdraw Money </a>
                                    </li>
                                    
                                    <li>
                                        <a href="{{ url('/req-money-history') }}"><i class="mdi mdi-cash-multiple" style="color: white !important;"></i> Withdraw History </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/mywallet') }}"><i class="mdi mdi-history" style="color: white !important;"></i> Transaction History </a>
                                    </li>
                                </ul>
                            </li>
                            @endif
                            @if(auth()->user()->is_admin)
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="mdi mdi-wallet" style="color: white !important;"></i>
                                    <span>All Wallet</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li>
                                        <a href="{{ url('/admin/wallet')}}"><i class="mdi mdi-history" style="color: white !important;"></i> Transaction History</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/req-money-history') }}"><i class="mdi mdi-cash-multiple" style="color: white !important;"></i> Withdraw History </a>
                                    </li>
                                    <!--li>
                                        <a href="{{ url('/mywallet') }}"><i class="mdi mdi-history" style="color: white !important;"></i>Transaction History </a>
                                    </li-->
                                </ul>
                            </li>
                            <li>                                
                                <a href="{{ url('/admin/subcribe-plans') }}" class="waves-effect">
                                    <i class="mdi mdi-floor-plan" style="color: white !important;"></i>
                                    <span>Subscribe Plans</span>
                                </a>                                
                            </li>
                            @endif

                            @if(!auth()->user()->is_admin)
                            <li>                                
                                <a href="{{ url('/plans') }}" class="waves-effect">
                                    <i class="mdi mdi-floor-plan" style="color: white !important;"></i>
                                    <span>Subscribe Plans</span>
                                </a>                                
                            </li>
                            @endif

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="mdi mdi-cog fa-2x" style="color: white !important;"></i>
                                    <span>Settings</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li>
                                        <a href="{{ url('/Profile') }}"><i class="mdi mdi-export" style="color: white !important;"></i>Profile</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/edit_profile/'.auth()->user()->id) }}"><i class="mdi mdi-message-draw" style="color: white !important;"></i>Edit Profile</a>
                                    </li>
                                    @if(!auth()->user()->is_admin)
                                    <li>
                                        <a href="{{ url('/create-account') }}"><i class="mdi mdi-account-plus" style="color: white !important;"></i> Add Accounts</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/change_pin') }}"><i class="mdi mdi-account-key" style="color: white !important;"></i>Change PIN</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/generate_pin') }}"><i class="mdi mdi-key-variant" style="color: white !important;"></i>Create New PIN</a>
                                    </li>
                                    @endif
                                </ul>
                            </li>

                            @if(auth()->user()->is_admin)
                            <li>
                                <a href="{{ url('/admin/config') }}" class="waves-effect">
                                    <i class="mdi mdi-trophy-award" style="color: white !important;"></i>
                                    <span>Configuration</span>
                                </a>
                            </li>
                            @endif

                            @if(auth()->user()->is_admin)
                            <li>
                                <a href="{{ url('/rewards') }}" class="waves-effect">
                                    <i class="mdi mdi-trophy-award" style="color: white !important;"></i>
                                    <span>Rewards</span>
                                </a>
                            </li>
                            @endif

                            <!-- <li>
                                <a href="#" class="waves-effect">
                                    <i class="mdi mdi-share-variant fa-2x" style="color: white !important;"></i>
                                    <span>Share</span>
                                </a>
                            </li> -->
                        </ul>
                    </div>
                    <!-- Sidebar -->
                </div>
            </div>
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">
                <div class="page-content">
                    <div class="container-fluid">
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between" style="font-size: initial;">
                                    <div class="page-title">
                                        <h4 class="mb-0 font-size-18">Kinney Pay</h4>
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="{{url()->current()}}">Menu</a></li>
                                            <li class="breadcrumb-item"><a href="{{url()->current()}}">Pages</a></li>
                                            <li class="breadcrumb-item active"><a href="{{url()->current()}}">@yield('page_name')</a></li>
                                        </ol>
                                    </div>

                                    <!-- <div class="state-information d-none d-sm-block">
                                        <div class="state-graph">
                                            <div id="header-chart-1"></div>
                                            <div class="info">Balance $ 2,317</div>
                                        </div>
                                        <div class="state-graph">
                                            <div id="header-chart-2"></div>
                                            <div class="info">Item Sold 1230</div>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        @yield('content')

                        <!-- end page content-->
                    </div>
                    <!-- container-fluid -->
                </div>
                <!-- content -->

                <footer class="footer">
                    © 2021 Kinney Wallet <span class="d-none d-sm-inline-block">- Crafted with <i class="mdi mdi-heart text-danger"></i> by Kinney Infotech.</span>
                </footer>
            </div>
        </div>
        <!-- Container-fluid -->

        <!-- End Page-content -->

        <script src="//code.tidio.co/gmzpuhloij9sic58lkz9kpazkqcscgbt.js" async></script>
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <img src="{{ asset('assets/images/App.png') }}" alt="" height="50px" />
                        <img src="{{ asset('assets/images/Play.png') }}" alt="" height="50px" /> 
                    </div>    
                    <div class="col-sm-12 text-center" style="color: red; font-weight: 800;">
                        <script>
                            document.write(new Date().getFullYear());
                        </script>
                        © Kinney Pay <span class="d-none d-sm-inline-block">- Crafted with <i class="mdi mdi-heart text-primary"></i> By Kinney Infotech.</span>
                    </div>
                </div>
            </div>
        </footer>

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- The Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <!-- w-100 class so that header
                div covers 100% width of parent div -->
                        <h5 class="modal-title w-100" id="exampleModalLabel"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">
                                ×
                            </span>
                        </button>
                    </div>

                    <!--Modal body with image-->
                    <div class="modal-body">
                        <img id="imgview" src="" />
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- The Modal End -->
       
  <!--Morris Chart-->
        <script src="{{ asset('assets/libs/morris.js/morris.min.js')}}"></script>
        <script src="{{ asset('assets/libs/raphael/raphael.min.js')}}"></script>
        <script src="{{ asset('assets/js/pages/morris.init.js')}}"></script>
        <!-- JAVASCRIPT -->
        <script src="{{ asset('assets/libs/jquery/jquery.min.js')}}"></script>
        <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{ asset('assets/libs/metismenu/metisMenu.min.js')}}"></script>
        <script src="{{ asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
        <script src="{{ asset('assets/libs/node-waves/waves.min.js')}}"></script>
        <script src="{{ asset('assets/libs/jquery-sparkline/jquery.sparkline.min.js')}}"></script>

        <!-- Required datatable js -->
        <script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
        <!-- Buttons examples -->
        <script src="{{ asset('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
        <script src="{{ asset('assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js')}}"></script>
        <script src="{{ asset('assets/libs/jszip/jszip.min.js') }}"></script>
        <script src="{{ asset('assets/libs/pdfmake/build/pdfmake.min.js')}}"></script>
        <script src="{{ asset('assets/libs/pdfmake/build/vfs_fonts.js')}}"></script>
        <script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
        <script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
        <script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.colVis.min.js')}}"></script>
        <!-- Responsive examples -->
        <script src="{{ asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
        <script src="{{ asset('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>

        <!-- Datatable init js -->
        <script src="{{asset('assets/js/pages/datatables.init.js')}}"></script>

        <!-- App js -->
        <script src="{{ asset('assets/js/app.js')}}"></script>

        <!-- Tidio Chat js -->
        <script src="{{ asset('assets/js/hidetdo.js')}}"></script>

        <!-- jQuery CDN -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <!-- Datatables JS CDN -->
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

        <!-- Script -->
        <script type="text/javascript">
            $(document).ready(function () {
                // DataTable
                $("#transactionHistory").DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{route('user.gettranshistory')}}",
                    columns: [
                        { data: "wallet_id" },
                        { data: "trans_to_name" },
                        { data: "trans_to_id" },
                        { data: "trans_id" },
                        { data: "score" },
                        /* { data: 'trans_by_id' }, */
                        { data: "trans_type" },
                        { data: "trans_by_name" },
                        { data: "remark" },
                        { data: "status" },
                        { data: "created_at" },
                    ],
                });
            });

            $(document).ready(function () {
                /* QR Code */
                $(".popup").click(function () {
                    var $src = $(this).attr("src");
                    $("#imgview").attr("src", $src);
                    $("#myModal").show();
                });
                $(".viewqr").click(function () {
                    var $src = $(this).attr("src");
                    $("#imgview").attr("src", $src);
                    $("#myModal").show();
                });

                $(".downloadqr").click(function () {
                    $.ajax({
                        type: "GET",
                        dataType: "json",
                        url: "/QRcode-Download",
                        data: { qrcode: $(this).attr("data-qr") },
                        success: function (data) {},
                    });
                });
            });

            $(".createqr").click(function () {
                var user_id = $(this).data("id");
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: "/QRcode-Create",
                    data: { user_id: user_id },
                    success: function (data) {
                        alert("QRCode created successfully");
                        window.location.reload();
                    },
                });
            });

            $("#mobile").on("keypress keyup blur",function (e) {
                    $(this).val($(this).val().replace(/[^0-9\.]/g,''));
                        if ((e.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                            event.preventDefault();
                        }
                    });
                    
            $("#amount").keypress(function (e) {
                //if the letter is not digit then display error and don't type anything
                if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                    //display error message
                    $("#errmsg").html("Digits Only").show().fadeOut("slow");
                        return false;
                }
              });
            $("#pin").keypress(function (e) {
                //if the letter is not digit then display error and don't type anything
                if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                    //display error message
                    $("#errmsg").html("Digits Only").show().fadeOut("slow");
                        return false;
                }
              });
            $("#newpin").keypress(function (e) {
                //if the letter is not digit then display error and don't type anything
                if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                    //display error message
                    $("#errmsg").html("Digits Only").show().fadeOut("slow");
                        return false;
                }
              });
  
</script>
<script src="{{ asset('assets/js/pages/intlTelInput.js')}}"></script>

  <script>
    
    var input = document.querySelector("#mobile");
    window.intlTelInput(input, {
     
       onlyCountries: ['in', 'my', 'ph'],
    
      utilsScript: "{{ asset('assets/js/pages/utils.js')}}",
    });
  </script>
  <script>

function updateSymbol(e){
   
  var selected = $(".currency-selector option:selected");
  $(".currency-symbol").text(selected.data("symbol"))
  $(".currency-amount").prop("placeholder", selected.data("placeholder"))
  $('.currency-addon-fixed').text(selected.text())
}

$(".currency-selector").on("change", updateSymbol)

updateSymbol()

 </script>
      <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
 <script>
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "light2",
	title:{
	//	text: "Line Chart"
	},
	data: [{        
		type: "line",
      	indexLabelFontSize: 16,
		dataPoints: [
			{ y: 450 },
			{ y: 414},
			{ y: 520, indexLabel: "\u2191 highest",markerColor: "red", markerType: "triangle" },
			{ y: 460 },
			{ y: 450 },
			{ y: 500 },
			{ y: 480 },
			{ y: 480 },
			{ y: 410 , indexLabel: "\u2193 lowest",markerColor: "DarkSlateGrey", markerType: "cross" },
			{ y: 500 },
			{ y: 480 },
			{ y: 510 }
		]
	}]
});
chart.render();

var chart1 = new CanvasJS.Chart("chartContainer1", {
	animationEnabled: true,
	theme: "light2",
	title:{
	//	text: "Line Chart"
	},
	data: [{        
		type: "area",
      	indexLabelFontSize: 16,
		dataPoints: [
			{ y: 450 },
			{ y: 414},
			{ y: 520, indexLabel: "\u2191 highest",markerColor: "red", markerType: "triangle" },
			{ y: 460 },
			{ y: 450 },
			{ y: 500 },
			{ y: 480 },
			{ y: 480 },
			{ y: 410 , indexLabel: "\u2193 lowest",markerColor: "DarkSlateGrey", markerType: "cross" },
			{ y: 500 },
			{ y: 480 },
			{ y: 510 }
		]
	}]
});
chart1.render();

}
</script>

    </body>
</html>
