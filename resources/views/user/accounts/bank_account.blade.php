@extends('layouts.layout')

@section('title')
Bank Account 
@endsection

@section('page_name')
    Bank Account 
@endsection

@section('content')
<div class="page-content-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <!-- Demo purpose only -->
                    <div style="min-height: 300px;">
                    <h3>  Bank Account </h3>
                    <hr/>
                        @if (session('message'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('message') }}
                            </div>
                        @endif
                        <form action="/store-bank-accounts" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <input type="hidden" name="user_id" value="{{ Auth()->user()->id  }}" />               
                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-md-2 col-form-label">Account Holder Name</label>
                                <div class="col-md-3">
                                    <input class="form-control" name="bank_acc_name" type="text" value="" id="bank_acc_name" required>  
                                    @if ($errors->has('bank_acc_name'))
                                        <span class="text-danger" style="color: ea1515 !important;">{{ $errors->first('bank_acc_name') }}</span>
                                    @endif                                                            
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-md-2 col-form-label">Account Number </label>
                                <div class="col-md-3">
                                    <input class="form-control" name="bank_acc_no" type="text" value="" id="bank_acc_no" required>
                                    @if ($errors->has('bank_acc_no'))
                                        <span class="text-danger" style="color: ea1515 !important;">{{ $errors->first('bank_acc_no') }}</span>
                                    @endif  
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-md-2 col-form-label">Re-Account Number </label>
                                <div class="col-md-3">
                                    <input class="form-control" name="re_bank_acc_no" type="text" value="" id="re_bank_acc_no" required>
                                    @if ($errors->has('re_bank_acc_no'))
                                        <span class="text-danger" style="color: ea1515 !important;">{{ $errors->first('re_bank_acc_no') }}</span>
                                    @endif 
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-md-2 col-form-label">Bank Name </label>
                                <div class="col-md-3">
                                    <input class="form-control" name="bank_name" type="text" value="" id="bank_name" required>
                                    @if ($errors->has('bank_name'))
                                        <span class="text-danger" style="color: ea1515 !important;">{{ $errors->first('bank_name') }}</span>
                                    @endif 
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-md-2 col-form-label">IFSC Code</label>
                                <div class="col-md-3">
                                    <input class="form-control" name="ifsc_code" type="text" value="" id="ifsc_code" required>
                                    @if ($errors->has('ifsc_code'))
                                        <span class="text-danger" style="color: ea1515 !important;">{{ $errors->first('ifsc_code') }}</span>
                                    @endif 
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-md-2 col-form-label">Branch Name</label>
                                <div class="col-md-3">
                                    <input class="form-control" name="branch_name" type="text" value="" id="branch_name" required>
                                    @if ($errors->has('branch_name'))
                                        <span class="text-danger" style="color: ea1515 !important;">{{ $errors->first('branch_name') }}</span>
                                    @endif 
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-md-2 col-form-label"> </label>
                                <div class="col-md-3">
                                    <input type="submit" value="Add bank" class="btn btn-primary">
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="row">
                            <table id="datatable" class="table table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Acc Holder Name</th>
                                    <th>Account </th>
                                    <th>Bank Name</th>
                                    <th>IFSC </th>
                                    <th>Branch Name</th>
                                    
                                </tr>
                            </thead>

                            <tbody>
                            @foreach($bankAccounts as $data) 
                            <tr>
                                <td> {{$loop->iteration}} </td>
                                <td>{{ $data->bank_acc_name }}</td>
                                <td>{{ $data->bank_acc_id }}</td>
                                <td>{{ $data->bank_name }}</td>
                                <td>{{ $data->ifsc_code }}</td>
                                <td>{{ $data->branch_name }}</td>
                                
                           
                                <td>
                                    <a onclick="return confirm('Really want to delete?')" href="{{ url('/destory-bank-account/'. $data->id ) }}"> <span style="font-size:20px"><i class="mdi mdi-delete" style="color: 3c5d7b !important;font-size: 1.2em;"></i></span></a>
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


@endsection
