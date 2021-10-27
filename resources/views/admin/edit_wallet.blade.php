@extends('layouts.layout')

@section('title')
Edit Wallet 
@endsection

@section('page_name')
Edit Wallet 
@endsection

@section('content')
<div class="page-content-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <!-- Demo purpose only -->
                    <div style="min-height: 300px;">
                    <h3> Edit wallet  </h3>
                    <hr/>
                    @if (session('message'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('message') }}
                        </div>
                    @endif
                    <form action="/admin/update_wallet" method="POST">
                    @csrf
                    <div class="mb-3 row">
                                                    <label class="col-md-2 col-form-label">User</label>
                                                    <div class="col-md-10">

                                                    <input class="form-control"  value="{{ $data->name }}" disabled type="text" 
                                                                id="example-text-input">
                                                    </div>
                                                </div>
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-md-2 col-form-label">Score</label>
                            <div class="col-md-10">
                                <input class="form-control" name="score" type="text" value="{{ $data->score }}"
                                                                id="example-text-input">
                            </div>
                        </div>
                        <div class="mb-3 row">
                                                    <label class="col-md-2 col-form-label">Status</label>
                                                    <div class="col-md-10">
                                                        <select class="form-select" name="status" aria-label="Default select example">
                                                            <option>Select</option>
                                                            <option value="Credited" @if($data->status == 'Credited') selected @endif>Credited</option>
                                                            <option value="Debited" @if($data->status == 'Debited') selected @endif>Debited</option>
                                                        </select>
                                                    </div>
                                                </div>
                        <div class="mb-3 row">
                                                    <label class="col-md-10 col-form-label"> </label>
                                                    <div class="col-md-2">
                                                        <!--input type="hidden" value="{{ $data->id }}" name="user_id" -->
                                                        <input type="hidden" value="{{ $data->wallet_id }}" name="wallet_id">
                                                        <input type="submit" value="Update" class="btn btn-primary">
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