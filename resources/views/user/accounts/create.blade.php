@extends('layouts.layout') 

@section('title') Add Account @endsection 

@section('page_name') <i class="mdi mdi-account-plus" style="color:white;"></i> Account @endsection @section('content')

<div class="page-content-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div style="min-height: 300px;">
                        <h3><i class="mdi mdi-account-plus" style="color:gray;"></i> Account</h3>
                        <hr />
                        @if (session('message'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('message') }}
                        </div>
                        @endif

                        <form action="/account-store" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <input type="hidden" name="user_id" value="{{ Auth()->user()->id  }}" />
                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-md-2 col-form-label">Account Type:</label>
                                <div class="col-md-3">
                                    <select class="form-control" name="trans_type"  required>
                                        <option value="" selected disabled hidden> -- Select Type--</option>
                                        <option value="kinney_vpo"> Kinney VPO</option>
                                        <option value="kinney_plus">Kinney Plus</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-md-2 col-form-label">Account Mobile/User ID:</label>
                                <div class="col-md-3">
                                    <input class="form-control" name="mobile" type="text" value="" required/>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-md-2 col-form-label">Account Password:</label>
                                <div class="col-md-3">
                                    <input class="form-control" name="password" type="password" value="" required/>
                                </div>
                            </div>         
                            <div class="mb-3 row">
                                <label class="col-md-2 col-form-label"> </label>
                                <div class="col-md-2">
                              
                                    <button class="btn btn-primary" type="submit"> Save</button>
                                </div>
                            </div>
                        </form>

                        <div class="row">
                            <table id="datatable" class="table table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Account #</th>
                                    <th>Account Type</th>
                                    <th>View Balance</th>
                                    <th>Action</th>         
                                </tr>
                            </thead>

                            <tbody>
                            @foreach($accounts as $data) 
                            <tr>
                                <td> {{$loop->iteration}} </td>
                                <td>{{ $data->username }}</td>
                                <td>{{substr_replace($data->unique_id, str_repeat('X', strlen($data->unique_id)-5), 1, -4);}}</td>
                                @if($data->acc_type == "kinney_vpo")
                                    <td>Kinney VPO</td>
                                @elseif($data->acc_type == "kinney_plus")
                                    <td>Kinney Plus</td>
                                @endif 

                                @php 
                                $kinneyplusAmt = \DB::connection('kinney_plus')->table("sb_user_wallet")->where('uw_user_id', $data->unique_id)->first();

                                $kinneyvpoAmt = \DB::connection('kinney_vpo')->table("sb_user_wallet")->where('uw_user_id', $data->unique_id)->first();
                                @endphp

                                @if($data->acc_type == "kinney_vpo")
                                    <td> ₹ {{$kinneyvpoAmt->uw_amount}} </td>
                                @elseif($data->acc_type == "kinney_plus")
                                    <td> ₹ {{$kinneyplusAmt->uw_amount}} </td>
                                @endif
                                
                                <td>
                                    <a onclick="return confirm('Really want to delete?')" href="{{ url('/admin/destory-account/'. $data->id ) }}"> <span style="font-size:20px"><i class="mdi mdi-delete" style="color: #3c5d7b !important;font-size: 1.2em;"></i></span></a>
                                </td>
                            </tr>
                            @endforeach

                            </tbody>
                        </table>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
