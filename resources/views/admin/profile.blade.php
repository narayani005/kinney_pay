@extends('layouts.layout')

@section('title')
    My Profile 
@endsection

@section('page_name')
    My Profile 
@endsection
@section('content')

<style>
    .user_detail{
        font-size:20px;
    }
</style>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<div class="page-content-wrapper">
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="clearfix">
                    @if (session('message'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('message') }}
                        </div>
                    @endif
                        <div class="directory-img float-start me-4">
                            <img class="rounded-circle avatar-lg img-thumbnail" src="{{ URL::to('/images/profile/' .$data->profile_img.'') }}" alt="{{ $data->name }}" />
                        </div>
                        <br/><br/>
                        <h2 class="fon-size-16"><a  href="{{ url('/edit_profile/' . $data->id) }}"> <p style="color:black" >{{ $data->name }}</p> </a></h2>
                        <p class="text-muted mb-2">{{ $data->role }}</p>
                    </div>
                    <br/>
                    <div class="mb-3 row">
                        <label class="col-md-2 col-form-label">E-Mail :</label>
                        <div class="col-md-5">
                            <div class="form-check">
                                <label class="col-md-4 col-form-label">{{ $data->email }}</label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-md-2 col-form-label">Mobile :</label>
                        <div class="col-md-5">
                            <div class="form-check">
                                <label class="col-md-4 col-form-label">{{ $data->mobile }}</label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-md-2 col-form-label">Account Type :</label>
                        <div class="col-md-5">
                            <div class="form-check">
                                @if($data->trans_type == "" || $data->trans_type == "kinney_pay")
                                <label class="col-md-4 col-form-label">Kinney Pay</label>
                                @else
                                <label class="col-md-4 col-form-label">{{ $data->trans_type }}</label>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-md-2 col-form-label">Added Accounts :</label>
                        <div class="col-md-5">
                            <div class="form-check">
                                @foreach($accounts as $acc)
                                    @if($acc->acc_type == 'kinney_plus')
                                    <label class="col-md-4 col-form-label"> Kinney Plus - {{ $acc->unique_id }} <br/></label>
                                    @elseif($acc->acc_type == 'kinney_vpo')
                                    <label class="col-md-4 col-form-label"> Kinney VPO - {{ $acc->unique_id }} <br/></label>
                                    @endif
                                    
                                @endforeach
                                
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-md-2 col-form-label">QR Code :</label>
                        <div class="col-md-5">
                    
                            <div class="form-check">
                                @if($data->qrcode == "")
                                <!--label class="col-md-4 col-form-label">{{ QrCode::size(80)->generate('127.0.0.1:8000/qrcode') }}</label-->
                                <label class="col-md-4 col-form-label">{{ QrCode::size(100)->generate($qrcode) }}</label>
                                @else
                                <label class="col-md-4 col-form-label">{{ QrCode::size(100)->generate($qrcode) }}</label>
                                <!--label class="col-md-4 col-form-label"><img class="" src="{{ URL::to('public/images/' .$data->qrcode.'.png') }}" style="width: 50%; height: 50%;" /></label-->
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-md-2 col-form-label"></label>
                        <div class="col-md-4">
                        <button class="btn btn-primary" type="submit" style="width: 110px;"data-toggle="modal" data-target="#plansModal"> View</button>
                       
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
        <div class="modal-content" style="width: 150%;">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">View QR Code</h4>
            </div>
            <div class="modal-body" style="margin-left: 125px;">
            <p> {{ QrCode::size(500)->generate($qrcode)}}</p>
                        </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <a id="download" href="a.jpg" download="a.jpg">
               
              
                <a href="{{ asset('assets/images/qrcode.png') }}" download>
                <button type="button" class="btn btn-primary" >Download</button>
                </a>

            </div>
        </div>
    </div>
</div>

@endsection
