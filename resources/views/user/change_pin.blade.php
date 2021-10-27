@extends('layouts.layout') 

@section('title') Change PIN @endsection 

@section('page_name') Change PIN @endsection @section('content')

<div class="page-content-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <!-- Demo purpose only -->
                    <div style="min-height: 300px;">
                        <h3>Change PIN</h3>
                        <hr />
                        @if (session('message'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('message') }}
                        </div>
                        @endif
                        <form action="/cpin_submit" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <input type="hidden" name="user_id" value="{{ Auth()->user()->id  }}" />
                           
                            
                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-md-2 col-form-label"> Old PIN Number:</label>
                                <div class="col-md-3">
                                    <input class="form-control" name="opin" type="password" id="pin" value="" maxlength="4" required/>
                                    <span id="errmsg" style="color: red;"></span>
                                </div>
                            </div> 
                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-md-2 col-form-label"> New PIN Number:</label>
                                <div class="col-md-3">
                                    <input class="form-control" name="npin" type="password" id="newpin" value="" maxlength="4" required/>
                                    <span id="errmsg" style="color: red;"></span>
                                </div>
                            </div>         
                            <div class="mb-3 row">
                                <label class="col-md-2 col-form-label"> </label>
                                <div class="col-md-2">
                                
                                    <button class="btn btn-primary" type="submit"> Change PIN</button>
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
