@extends('layouts.layout') 

@section('title') Withdraw Money @endsection 

@section('page_name') Withdraw Money @endsection @section('content')

<div class="page-content-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <!-- Demo purpose only -->
                    <div style="min-height: 300px;">
                        <h3>Withdraw Money</h3>
                        <hr />
                        @if (session('message'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('message') }}
                        </div>
                        @endif
                        <form action="/req_money_submit" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-md-2 col-form-label">Mobile :</label>
                                <div class="col-md-3">
                                    <input class="form-control" name="mobile" type="text" id="mobile" value="" Placeholder="Enter Mobile" required/>
                                    <span id="errmsg" style="color: red;"></span>
                                </div>
                            </div>

                            <div class="mb-3 row ">
                                <label class="col-md-2 col-form-label">Account Type :</label>
                                <div class="col-md-1">
                                    <div class="form-check">
                                        <input class="form-check-input" checked type="radio" name="trans_type" id="trans_type" value="kinney_pay" required>
                                        <label class="form-check-label" for="trans_type">
                                            Kinney Pay
                                        </label>
                                    </div>
                                </div>
                                <!--div class="col-md-1">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="trans_type" id="trans_type" value="kinney_plus" required>
                                        <label class="form-check-label" for="trans_type">
                                            Kinney Plus
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="trans_type" id="trans_type" value="kinney_vpo" required>
                                        <label class="form-check-label" for="trans_type">
                                            Kinney VPO
                                        </label>
                                    </div>
                                </div-->
                            </div>


                            <div class="mb-3 row ">
                                <label class="col-md-2 col-form-label">Bank Account :</label>
                               @foreach($bank_acc as $bank)
                                <div class="col-md-1">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="bank_acc_id" id="{{ $bank->bank_name }}" value="{{$bank->id}}" required>
                                        <label class="form-check-label" for="{{ $bank-> bank_name }}">
                                            {{ $bank->bank_name }}
                                        </label>
                                    </div>
                                </div>
                                @endforeach
                            </div>


                            
                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-md-2 col-form-label">Amount :</label>
                                <div class="col-md-3">
                                    <input class="form-control" name="req_amt" type="text" id="req_amt" value="" Placeholder="Enter Amount" required/>
                                    <span id="errmsg" style="color: red;"></span>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-md-2 col-form-label"> </label>
                                <div class="col-md-3">
                                    <input type="hidden" value="{{auth()->user()->id}}" name="req_user_id">
                                    <button class="btn btn-primary" type="submit" @if($bank_count <= 0) disabled @endif  > Request </button>
                                    @if($bank_count <= 0) 
                                    <br/>
                                    <span id="errmsg" style="color: red;">Please add bank account to withdraw money</span>
                                    @endif

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
