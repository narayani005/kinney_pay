@extends('layouts.layout') 

@section('title') Subscribe Plans @endsection 

@section('page_name') Subscribe Plans @endsection @section('content')

<div class="page-content-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <!-- Demo purpose only -->
                    <div style="min-height: 300px;">
                        <h3>Subscribe Plans</h3>
                        <hr />
                        @if (session('message'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('message') }}
                        </div>
                        @endif
                        <div class="pricing-table">
                            <div class="ptable-item">
                                <div class="ptable-single">
                                    <div class="ptable-header">
                                        <div class="ptable-title">
                                            <h2>Silver</h2>
                                        </div>
                                        <div class="ptable-price">
                                            <h2><small>₹ </small>1,200<span>/7 DAYS</span></h2>
                                        </div>
                                    </div>
                                    <div class="ptable-body">
                                        <div class="ptable-description">
                                        
                                        <ul style="text-align:left;">
                                        
                                               <li >DURATION <span style="color:#FF6F61;margin-right: -1rem;">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;7 DAYS</span></li>
                                                <li>PROJECT PAYOUT <span style="color:#FF6F61">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;₹ 4,200</span></li>
                                                <li>TOTAL PAYOUT <span style="color:#FF6F61">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;₹ 3,000</span></li>
                                                <li>PROJECT TYPE <span style="color:#FF6F61">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;ONE TIME </span></li>
                                                <li>SUPPORT <span style="color:#FF6F61">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;24 HOURSE</span></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="ptable-footer">
                                        <div class="ptable-action">
                                        <a href="">BUY NOW</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="ptable-item featured-item">
                                <div class="ptable-single">
                                    <div class="ptable-header">
                                        <div class="ptable-status"></div>
                                        <div class="ptable-title">
                                            <h2>Gold</h2>
                                        </div>
                                        <div class="ptable-price">
                                        <h2><small>₹ </small>1,800<span>/7 DAYS</span></h2>
                                        </div>
                                    </div>
                                    <div class="ptable-body">
                                        <div class="ptable-description">
                                        <ul style="text-align:left;">
                                        <li >DURATION <span style="color:#FF6F61;margin-right: -1rem;">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;7 DAYS</span></li>
                                                <li>PROJECT PAYOUT <span style="color:#FF6F61">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;₹ 4,200</span></li>
                                                <li>TOTAL PAYOUT <span style="color:#FF6F61">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;₹ 3,000</span></li>
                                                <li>PROJECT TYPE <span style="color:#FF6F61">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;ONE TIME </span></li>
                                                <li>SUPPORT <span style="color:#FF6F61">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;24 HOURSE</span></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="ptable-footer">
                                        <div class="ptable-action">
                                        <a href="">BUY NOW</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="ptable-item">
                                <div class="ptable-single">
                                    <div class="ptable-header">
                                        <div class="ptable-title">
                                            <h2>Platinum</h2>
                                        </div>
                                        <div class="ptable-price">
                                        <h2><small>₹ </small>2,500<span>/7 DAYS</span></h2>
                                        </div>
                                    </div>
                                    <div class="ptable-body">
                                        <div class="ptable-description">
                                            <ul style="text-align:left;">
                                            <li >DURATION <span style="color:#FF6F61;margin-right: -1rem;">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;7 DAYS</span></li>
                                                <li>PROJECT PAYOUT <span style="color:#FF6F61">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;₹ 4,200</span></li>
                                                <li>TOTAL PAYOUT <span style="color:#FF6F61">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;₹ 3,000</span></li>
                                                <li>PROJECT TYPE <span style="color:#FF6F61">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;ONE TIME </span></li>
                                                <li>SUPPORT <span style="color:#FF6F61">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;24 HOURSE</span></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="ptable-footer">
                                        <div class="ptable-action">
                                        <a href="">BUY NOW</a>
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

@endsection
