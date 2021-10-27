@extends('layouts.layout') 

@section('title') Add Account @endsection 

@section('page_name') Add Account @endsection @section('content')

<div class="page-content-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <!-- Demo purpose only -->
                    <div style="min-height: 300px;">
                        <h3>Add Account</h3>
                        <hr />
                        @if (session('message'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('message') }}
                        </div>
                        @endif
                        <form action="/acc_submit" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <input type="hidden" name="user_id" value="{{ Auth()->user()->id  }}" />
                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-md-2 col-form-label">Acc Type:</label>
                                <div class="col-md-3">
                                    <select class="form-control" name="trans_type"  required>
                                        <option> -- Select Type--</option>
                                        <option value="kinney_vpo"> Kinney VPO</option>
                                        <option value="kinney_plus">Kinney Plus</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-md-2 col-form-label">Acc Mobile:</label>
                                <div class="col-md-3">
                                    <input class="form-control" name="mobile" type="text" value="" required/>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-md-2 col-form-label">Acc Password:</label>
                                <div class="col-md-3">
                                    <input class="form-control" name="password" type="password" value="" required/>
                                </div>
                            </div>         
                            <div class="mb-3 row">
                                <label class="col-md-2 col-form-label"> </label>
                                <div class="col-md-2">
                                
                                    <button class="btn btn-primary" type="submit"> Add Account</button>
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
