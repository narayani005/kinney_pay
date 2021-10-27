@extends('layouts.layout')

@section('title')
   Send Money
@endsection

@section('page_name')
    Send Money
@endsection

@section('content')
<div class="page-content-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <!-- Demo purpose only -->
                    <div style="min-height: 300px;">
                    <h3> Send Money to Beneficiary </h3>
                    <hr/>
                    @if (session('message'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('message') }}
                        </div>
                    @endif
                    <form action="/wallet_trans" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <div class="mb-3 row ">
                                <label class="col-md-2 col-form-label">Account Type :</label>
                                <div class="col-md-1">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="trans_type" id="trans_type" value="kinney_pay" required>
                                        <label class="form-check-label" for="trans_type">
                                            Kinney Pay
                                        </label>
                                    </div>
                                </div>
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
                                                    <label class="col-md-2 col-form-label">Beneficiary</label>
                                                    <div class="col-md-3">
                                                        <select class="form-select" name="trans_to_id" aria-label="Default select example">
                                                            <option>Select</option>
                                                            @foreach($datas as $data)
                                                            <option value="{{ $data->benefi_id }}">{{ $data->benefi_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-md-2 col-form-label">Mobile</label>
                            <div class="col-md-3">
                                <input class="form-control" name="mobile" type="text" value=""
                                                                id="mobile" placeholder=" ">
                                                                <span id="errmsg" style="color: red;"></span>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-md-2 col-form-label">Amount</label>
                            <div class="col-md-3">
                                <input class="form-control" name="score" type="text" value=""
                                                                id="amount">
                                                                <span id="errmsg" style="color: red;"></span>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-md-2 col-form-label">Pin Number </label>
                            <div class="col-md-3">
                                <input class="form-control" name="uid" type="text" value=""
                                                                id="pin">
                                                                <span id="errmsg" style="color: red;"></span>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-md-2 col-form-label">Remarks </label>
                            <div class="col-md-3">
                                <textarea class="form-control" name="remark" type="text" value=""
                                                                id="example-text-input"> </textarea>
                            </div>
                        </div>
                        
                                              
                        <div class="mb-3 row">
                                                    <label class="col-md-2 col-form-label"> </label>
                                                    <div class="col-md-3">
                                                        <input type="hidden" name="trans_by_id" value="{{ auth()->user()->id }}" >
                                                        <input type="hidden" name="trans_by_name" value="{{ auth()->user()->name }}" >
                                                        <input type="submit" value="Add Wallet" class="btn btn-primary">
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
