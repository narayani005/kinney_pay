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
                    <h3> Send Money  </h3>
                    <hr/>

                    <form action="/admin/wallet_submit" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <div class="mb-3 row">
                                                    <label class="col-md-2 col-form-label">User</label>
                                                    <div class="col-md-4">
                                                        <select class="form-select" name="trans_to_id" aria-label="Default select example">
                                                            <option>Select</option>
                                                            @foreach($datas as $data)
                                                            <option value="{{ $data->id }}">{{ $data->name }} - {{ $data->mobile }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-md-2 col-form-label">Amount</label>
                            <div class="col-md-4">
                                <input class="form-control" name="score" type="text" value=""
                                                                id="example-text-input">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-md-2 col-form-label">Remarks </label>
                            <div class="col-md-4">
                                <textarea class="form-control" name="remark" type="text" value=""
                                                                id="example-text-input"> </textarea>
                            </div>
                        </div>
                    
                                                <!--div class="mb-3 row">
                                                    <label class="col-md-2 col-form-label">Account Type</label>
                                                    <div class="col-md-10">
                                                        <select class="form-select" name="trans_type" aria-label="Default select example">
                                                            <option>Select</option>
                                                            <option value="kinney_pay">Kinney Pay</option>
                                                            <option value="kinney_plus">Kinney Plus</option>
                                                            <option value="kinney_vpo">Kinney VPO</option>
                                                            
                                                        </select>
                                                    </div>
                                                </div-->
                        <div class="mb-3 row">
                                                    <label class="col-md-2 col-form-label"> </label>
                                                    <div class="col-md-2">
                                                    
                                                        <input type="hidden" name="trans_type" value="kinney_pay" >
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