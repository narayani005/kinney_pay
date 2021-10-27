@extends('layouts.layout') 

@section('title') Subscribe Plans @endsection 

@section('page_name') Subscribe Plans @endsection @section('content')
<div class="page-content-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <!-- Demo purpose only -->
                    <div style="min-height: auto;">
                        <h3>Subscribe Plans</h3>
                        <hr />
                        @if (session('message'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('message') }}
                        </div>
                        @endif
                        <link href="{{ asset('assets/css/subplans.css')}}" id="int-style" rel="stylesheet" type="text/css" />
                        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
                        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
                        <div id="generic_price_table">
                            <section>
                                <div class="container">
                                    <!--BLOCK ROW START-->
                                    <div class="row">
                                        <div class="col-md-4">
                                            <!--PRICE CONTENT START-->
                                            <div class="generic_content active clearfix">
                                                <!--HEAD PRICE DETAIL START-->
                                                <div class="generic_head_price clearfix">
                                                    <!--HEAD CONTENT START-->
                                                    <div class="generic_head_content clearfix">
                                                        <!--HEAD START-->
                                                        <div class="head_bg"></div>
                                                        <div class="head">
                                                            <span>Basic</span>
                                                        </div>
                                                        <!--//HEAD END-->
                                                    </div>
                                                    <!--//HEAD CONTENT END-->

                                                    <!--PRICE START-->
                                                    <div class="generic_price_tag clearfix">
                                                        <span class="price">
                                                            <span class="sign">₹ 3,000</span>
                                                            <span class="month">/7 DAYS</span>
                                                        </span>
                                                    </div>
                                                    <!--//PRICE END-->
                                                </div>
                                                <!--//HEAD PRICE DETAIL END-->

                                                <!--FEATURE LIST START-->
                                                <div class="generic_feature_list">
                                                    <ul>
                                                       <!-- <li> DURATION <span> 7 DAYS</span></li>-->
                                                        <li> PROJECT PAYOUT <span> ₹ 4,200</span></li>
                                                        <li> TOTAL PAYOUT <span> ₹ 4,200</span></li>
                                                        <li> PROJECT TYPE <span> ONE TIME PURCHASE</span></li>
                                                        <li> SUPPORT<span> 24 HOURS</span></li>
                                                    </ul>
                                                </div>
                                                <!--//FEATURE LIST END-->

                                                <!--BUTTON START-->
                                                <div class="generic_price_btn clearfix">
                                                    <a data-toggle="modal" data-target="#plansModal"><i class="mdi mdi-cart"></i> Buy Now</a>
                                                </div>
                                                <!--//BUTTON END-->
                                            </div>
                                            <!--//PRICE CONTENT END-->
                                        </div>

                                        <div class="col-md-4">
                                            <!--PRICE CONTENT START-->
                                            <div class="generic_content active clearfix">
                                                <!--HEAD PRICE DETAIL START-->
                                                <div class="generic_head_price clearfix">
                                                    <!--HEAD CONTENT START-->
                                                    <div class="generic_head_content clearfix">
                                                        <!--HEAD START-->
                                                        <div class="head_bg"></div>
                                                        <div class="head">
                                                            <span>Unlimited</span>
                                                        </div>
                                                        <!--//HEAD END-->
                                                    </div>
                                                    <!--//HEAD CONTENT END-->

                                                    <!--PRICE START-->
                                                    <div class="generic_price_tag clearfix">
                                                        <span class="price">
                                                       <span class="sign">₹ 25,000</span>
                                                        <span class="month">/30 Days</span>
                                                        </span>
                                                    </div>
                                                    <!--//PRICE END-->
                                                </div>
                                                <!--//HEAD PRICE DETAIL END-->

                                                <!--FEATURE LIST START-->
                                                <div class="generic_feature_list">
                                                    <ul>
                                                    <li> PROJECT PAYOUT <span> ₹ 37,500</span></li>
                                                        <li> TOTAL PAYOUT <span> ₹ 37,500</span></li>
                                                        <li> PROJECT TYPE <span> ONE TIME PURCHASE</span></li>
                                                        <li> SUPPORT<span> 24 HOURS</span></li>
                                                    </ul>
                                                </div>
                                                <!--//FEATURE LIST END-->

                                                <!--BUTTON START-->
                                                <div class="generic_price_btn clearfix">
                                                    <a data-toggle="modal" data-target="#plansModal"><i class="mdi mdi-cart"></i> Buy Now</a>
                                                </div>
                                                <!--//BUTTON END-->
                                            </div>
                                            <!--//PRICE CONTENT END-->
                                        </div>
                                        <div class="col-md-4">
                                            <!--PRICE CONTENT START-->
                                            <div class="generic_content active clearfix">
                                                <!--HEAD PRICE DETAIL START-->
                                                <div class="generic_head_price clearfix">
                                                    <!--HEAD CONTENT START-->
                                                    <div class="generic_head_content clearfix">
                                                        <!--HEAD START-->
                                                        <div class="head_bg"></div>
                                                        <div class="head">
                                                            <span>Standard</span>
                                                        </div>
                                                        <!--//HEAD END-->
                                                    </div>
                                                    <!--//HEAD CONTENT END-->

                                                    <!--PRICE START-->
                                                    <div class="generic_price_tag clearfix">
                                                        <span class="price">
                                                        <span class="sign">₹ 50,000</span>
                                                        <span class="month">/3 MONTH</span>
                                                        </span>
                                                    </div>
                                                    <!--//PRICE END-->
                                                </div>
                                                <!--//HEAD PRICE DETAIL END-->

                                                <!--FEATURE LIST START-->
                                                <div class="generic_feature_list">
                                                    <ul>
                                                     <!--<li> DURATION <span> 3 MONTH </span></li>-->
                                                        <li> PROJECT PAYOUT <span> ₹ 80,500</span></li>
                                                        <li> TOTAL PAYOUT <span> ₹ 80,500</span></li>
                                                        <li> PROJECT TYPE <span> ONE TIME PURCHASE</span></li>
                                                        <li> SUPPORT<span> 24 HOURS</span></li>
                                                    </ul>
                                                </div>
                                                <!--//FEATURE LIST END-->

                                                <!--BUTTON START-->
                                                <div class="generic_price_btn clearfix">
                                                    <a data-toggle="modal" data-target="#plansModal"><i class="mdi mdi-cart"></i> Buy Now</a>
                                                </div>
                                                <!--//BUTTON END-->
                                            </div>
                                            <!--//PRICE CONTENT END-->
                                        </div>
                                    </div>
                                    <!--//BLOCK ROW END-->
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Plans Model -->
<div class="modal fade" id="plansModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Subscribe Plans</h4>
            </div>
            <div class="modal-body">
                <img src="{{ URL::to('/assets/img/check.png') }}" alt="peng ting" width="50px" height="50px" style="display: block; margin-left: auto; margin-right: auto;"><br>
                <p style="font-size: x-large;color: #060606;text-align: center;">Thanks you for subscribing!</p>
                <p style="font-size: larger;color: red;text-align: center;">Your request has been successfully submitted and is being processed by the Kinney Pay Admin.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@endsection
