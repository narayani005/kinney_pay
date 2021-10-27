@extends('layouts.layout')

@section('title')
Dashboard 
@endsection

@section('page_name')
Dashboard 
@endsection

@section('content')
<div class="page-content-wrapper">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <!-- Demo purpose only -->
                    <div style="min-height: 300px;">
                        <h3>Dashboard</h3>
                        <hr />
                        @if (session('message'))
                        <div class="alert alert-success" role="alert">
                            {{ session('message') }}
                        </div>
                        @endif
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary mini-stat position-relative" style="height: 150px;">
                                    <div class="card-body">
                                        <div class="mini-stat-desc">
                                            <h5 class="text-uppercase verti-label font-size-16 text-white-50">Wallet</h5>
                                            <div class="text-white">
                                                <h5 class="text-uppercase font-size-16 text-white-50">{{auth()->user()->name}}</h5>

                                                <h3 class="mb-3 text-white">₹ {{ $data->total_amt }}</h3>
                                                <div class="">
                                                    <!--a href=""><h4><span class="badge bg-dark">  Share </span></h4> </a-->
                                                </div>
                                            </div>
                                            <div class="mini-stat-icon">
                                                <i class="mdi mdi-cube-outline display-2"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary mini-stat position-relative" style="height: 150px;">
                                    <div class="card-body">
                                        <div class="mini-stat-desc">
                                            <h5 class="text-uppercase verti-label font-size-16 text-white-50">Beneficiary</h5>
                                            <div class="text-white">
                                                <h5 class="text-uppercase font-size-16 text-white-50">{{auth()->user()->name}}</h5>

                                                <h3 class="mb-3 text-white"><i class="mdi mdi-account-multiple"></i> {{$benefi}} Members</h3>
                                            </div>
                                            <div class="mini-stat-icon">
                                                <i class="mdi mdi-cube-outline display-2"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary mini-stat position-relative" style="height: 150px;">
                                    <div class="card-body">
                                        <div class="mini-stat-desc">
                                            <h5 class="text-uppercase verti-label font-size-16 text-white-50">History</h5>
                                            <div class="text-white">
                                                <h5 class="text-uppercase font-size-16 text-white-50">{{auth()->user()->name}}</h5>

                                                <h3 class="mb-3 text-white"><i class="mdi mdi-arrow-down"></i> ₹ {{$trans_to_amt}} <i class="mdi mdi-arrow-up"></i> ₹ {{$trans_by_amt}}</h3>
                                            </div>
                                            <div class="mini-stat-icon">
                                                <i class="mdi mdi-cube-outline display-2"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-6 col-md-6">
        <div id="chartContainer" style="height: 370px; width: 100%;"></div>
    </div>
    <div class="col-xl-6 col-md-6">
        <div id="chartContainer1" style="height: 370px; width: 100%;"></div>
    </div>
</div>

@endsection