@extends('layouts.layout') 

@section('title') Rewards @endsection 

@section('page_name') Rewards @endsection @section('content')

<div class="page-content-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <!-- Demo purpose only -->
                    <div style="min-height: auto;">
                        <h3>Rewards</h3>
                        <hr style="border-top: 0px solid rgba(0, 0, 0, 0.1);" />
                        @if (session('message'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('message') }}
                        </div>
                        @endif

                        <link href="{{ asset('assets/css/rewards.css')}}" id="int-style" rel="stylesheet" type="text/css" />

                        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
                        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

                        <div id="silder" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#silder" data-slide-to="0" class="active"></li>
                                <li data-target="#silder" data-slide-to="1"></li>
                                <li data-target="#silder" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img class="d-block w-50" style="height: auto; display: block; margin: 0 auto;" src="{{ URL::to('/images/rewards/banner/banner-one.png') }}" alt="First slide" />
                                    <div class="carousel-caption d-none d-md-block"></div>
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block w-50" style="height: auto; display: block; margin: 0 auto;" src="{{ URL::to('/images/rewards/banner/banner-two.png') }}" alt="Second slide" />
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block w-50" style="height: auto; display: block; margin: 0 auto;" src="{{ URL::to('/images/rewards/banner/banner-three.png') }}" alt="Third slide" />
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#silder" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#silder" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>

                        <br />
                        <div class="pricing-table">
                            <div class="ptable-item">
                                <div class="ptable-single">
                                    <img class="rounded avatar-lg img-thumbnail" style="height: auto; display: block; margin: 0 auto;" src="{{ URL::to('/images/rewards/rewards.png') }}" />
                                    <div class="ptable-body">
                                        <div class="ptable-description">
                                            <div class="ptable-footer">
                                                <div class="ptable-action">
                                                    <button class="btn btn-primary" type="submit">Award #2</button>
                                                </div>
                                            </div>
                                            <ul>
                                                <li><b>Lorem ipsum dolor sit,amet, consectetur</b></li>
                                                <li><b>adipiscing elit.Morbi quis arcu imperdiet,</b></li>
                                                <li><b>volupat urna nec,vestibulum orci. Morbi</b></li>
                                                <li><b>tristique, dui vel porta</b></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="ptable-item featured-item">
                                <div class="ptable-single">
                                    <img class="rounded avatar-lg img-thumbnail" style="height: auto; display: block; margin: 0 auto;" src="{{ URL::to('/images/rewards/rewards.png') }}" />
                                    <div class="ptable-body">
                                        <div class="ptable-description">
                                            <div class="ptable-footer">
                                                <div class="ptable-action">
                                                    <button class="btn btn-primary" type="submit">Award #1</button>
                                                </div>
                                            </div>
                                            <ul>
                                                <li><b>Lorem ipsum dolor sit,amet, consectetur</b></li>
                                                <li><b>adipiscing elit.Morbi quis arcu imperdiet,</b></li>
                                                <li><b>volupat urna nec,vestibulum orci. Morbi</b></li>
                                                <li><b>tristique, dui vel porta</b></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="ptable-item">
                                <div class="ptable-single">
                                    <img class="rounded avatar-lg img-thumbnail" style="height: auto; display: block; margin: 0 auto;" src="{{ URL::to('/images/rewards/rewards.png') }}" />
                                    <div class="ptable-body">
                                        <div class="ptable-description">
                                            <div class="ptable-footer">
                                                <div class="ptable-action">
                                                    <button class="btn btn-primary" type="submit">Award #3</button>
                                                </div>
                                            </div>
                                            <ul>
                                                <li><b>Lorem ipsum dolor sit,amet, consectetur</b></li>
                                                <li><b>adipiscing elit.Morbi quis arcu imperdiet,</b></li>
                                                <li><b>volupat urna nec,vestibulum orci. Morbi</b></li>
                                                <li><b>tristique, dui vel porta</b></li>
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