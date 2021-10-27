@extends('layouts.layout') 

@section('title') Self Transaction @endsection 

@section('page_name') Self Transaction @endsection @section('content')

<div class="page-content-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <!-- Demo purpose only -->
                    <div style="min-height: 300px;">
                        <h3>Self Transaction</h3>
                        <hr />
                        @if (session('message'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('message') }}
                        </div>
                        @endif
                        <form action="/credit-debit" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <div class="mb-3 row">
                                <label class="col-md-2 col-form-label">Transfer To :</label>
                                <div class="col-md-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="self_account" id="self_account" value="{{ auth()->user()->mobile }}" checked>
                                        <label class="form-check-label" for="self_account">
                                            Self Account
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-md-2 col-form-label">Amount :</label>
                                <div class="col-md-3">
                                    <input class="form-control" name="score" type="text" value="" id="amount" Placeholder="Enter Amount" required/>
                                    <span id="errmsg" style="color: red;"></span>
                                </div>
                            </div>

                            <div class="mb-3 row ">
                                <label class="col-md-2 col-form-label">Account Type :</label>
                                <div class="col-md-1">
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
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-md-2 col-form-label">Acc Mobile :</label>
                                <div class="col-md-3">
                                    <input class="form-control" name="mobile" type="text" value="" id="mobile" Placeholder="Enter Acc Mobile" required/>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-md-2 col-form-label">Remarks :</label>
                                <div class="col-md-3">
                                    <textarea class="form-control" name="remark" placeholder="Describe something here." rows = "4" cols = "30" required> </textarea>
                                </div>
                            </div>
                            
                            <div class="mb-3 row">
                                <label class="col-md-2 col-form-label"> </label>
                                <div class="col-md-3">
                                    <button class="btn btn-primary" type="submit"> Add Wallet</button>
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
