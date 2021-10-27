@extends('layouts.layout') 

@section('title') Generate PIN @endsection 

@section('page_name') Generate PIN @endsection @section('content')

<div class="page-content-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <!-- Demo purpose only -->
                    <div style="min-height: 300px;">
                        <h3>Generate PIN</h3>
                        <hr />
                        @if (session('message'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('message') }}
                        </div>
                        @endif
                        @if(empty(auth()->user()->uid))
                        <form action="/pin_submit" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <input type="hidden" name="user_id" value="{{ Auth()->user()->id  }}" />
                           
                            
                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-md-2 col-form-label"> PIN Number:</label>
                                <div class="col-md-3">
                                    <input class="form-control" name="gpin" type="password" id="pin" value="" maxlength="4" required/>
                                    <span id="errmsg" style="color: red;"></span>
                                </div>
                            </div> 
                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-md-2 col-form-label"> Confirm PIN Number:</label>
                                <div class="col-md-3">
                                    <input class="form-control" name="cpin" type="password" id="newpin" value="" maxlength="4" required/>
                                   <span id="errmsg" style="color: red;"></span>
                                </div>
                            </div>         
                            <div class="mb-3 row">
                                <label class="col-md-2 col-form-label"> </label>
                                <div class="col-md-3">
                                
                                    <button class="btn btn-primary" type="submit"> Generate PIN</button>
                                </div>
                            </div>
                        </form>
                        @else
                        <div class="mb-3 row">
                                <label class="col-md-2 col-form-label"> </label>
                                <div class="col-md-3">
                                    <h3> Pin Already Generated</h3>
                                    <br/>
                                    <a href="{{ url('/forget_pin' ); }}" class="btn btn-primary" > Forgot PIN ? </a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
