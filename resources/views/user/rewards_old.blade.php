@extends('layouts.layout') 

@section('title') Rewards @endsection 

@section('page_name') Rewards @endsection @section('content')

<div class="page-content-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <!-- Demo purpose only -->
                    <div style="min-height: 300px;">
                        <h3>Awards</h3>
                        <hr />
                        @if (session('message'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('message') }}
                        </div>
                        @endif

                        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" />


                                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                        <li data-target="#myCarousel" data-slide-to="1"></li>
                                        <li data-target="#myCarousel" data-slide-to="2"></li>
                                    </ol>

                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" style="height: 425px;">
                                        <div class="item active">
                                            <img class="rounded avatar-lg img-thumbnail" style="width: 100%;" src="{{ URL::to('/images/profile/aw1.png') }}" />
                                        </div>

                                        <div class="item">
                                            <img class="rounded avatar-lg img-thumbnail" style="width: 100%;" src="{{ URL::to('/images/profile/aw2.png') }}" />
                                        </div>

                                        <div class="item">
                                            <img class="rounded avatar-lg img-thumbnail" style="width: 100%;" src="{{ URL::to('/images/profile/aw3.jpg') }}" />
                                        </div>
                                    </div>

                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                                        <span class="glyphicon glyphicon-chevron-left"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="right carousel-control" href="#myCarousel" data-slide="next">
                                        <span class="glyphicon glyphicon-chevron-right"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>


                        <br />
                        <div class="pricing-table">
                            <div class="ptable-item">
                                <div class="ptable-single">
                                    <img class="rounded avatar-lg img-thumbnail" style="width: 100%; height: 100%;" src="{{ URL::to('/images/profile/gold-trophy.jpg') }}" />
                                    <div class="ptable-body">
                                        <div class="ptable-description">
                                            <div class="ptable-footer">
                                                <div class="ptable-action">
                                                    <a href="">Award #2</a>
                                                </div>
                                            </div>
                                            <ul>
                                                <li>Lorem ipsum dolor sit,amet, consectetur</li>
                                                <li>adipiscing elit.Morbi quis arcu imperdiet,</li>
                                                <li>volupat urna nec,vestibulum orci. Morbi</li>
                                                <li>tristique, dui vel porta</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="ptable-item featured-item">
                                <div class="ptable-single">
                                    <img class="rounded avatar-lg img-thumbnail" style="width: 100%; height: 100%;" src="{{ URL::to('/images/profile/download.jpeg') }}" />
                                    <div class="ptable-body">
                                        <div class="ptable-description">
                                            <div class="ptable-footer">
                                                <div class="ptable-action">
                                                    <a href="">Award #1</a>
                                                </div>
                                            </div>
                                            <ul>
                                                <li>Lorem ipsum dolor sit,amet, consectetur</li>
                                                <li>adipiscing elit.Morbi quis arcu imperdiet,</li>
                                                <li>volupat urna nec,vestibulum orci. Morbi</li>
                                                <li>tristique, dui vel porta</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="ptable-item">
                                <div class="ptable-single">
                                    <img class="rounded avatar-lg img-thumbnail" style="width: 100%; height: 100%;" src="{{ URL::to('/images/profile/gold-trophy.jpg') }}" />
                                    <div class="ptable-body">
                                        <div class="ptable-description">
                                            <div class="ptable-footer">
                                                <div class="ptable-action">
                                                    <a href="">Award #3</a>
                                                </div>
                                            </div>
                                            <ul>
                                                <li>Lorem ipsum dolor sit,amet, consectetur</li>
                                                <li>adipiscing elit.Morbi quis arcu imperdiet,</li>
                                                <li>volupat urna nec,vestibulum orci. Morbi</li>
                                                <li>tristique, dui vel porta</li>
                                            </ul>
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