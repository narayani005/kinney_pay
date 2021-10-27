@extends('layouts.layout') 

@section('title') Forgot PIN @endsection 

@section('page_name') Forgot PIN @endsection @section('content')

<div class="page-content-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <!-- Demo purpose only -->
                    <div style="min-height: 300px;">
                        <h3>Forgot PIN</h3>
                        <hr />
                        @if (session('message'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('message') }}
                        </div>
                        @endif
                        <form action="/pin_submit" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <input type="hidden" name="user_id" value="{{ Auth()->user()->id  }}" />
                           
                            
                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-md-2 col-form-label"> PIN Number:</label>
                                <div class="col-md-4">
                                    <input class="form-control" name="gpin" type="password" value="" maxlength="4" required/>
                                </div>
                            </div> 
                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-md-2 col-form-label"> Confirm PIN Number:</label>
                                <div class="col-md-4">
                                    <input class="form-control" name="cpin" type="password" value="" maxlength="4" required/>
                                </div>
                            </div>         
                            <div class="mb-3 row">
                                <label class="col-md-5 col-form-label"> </label>
                                <div class="col-md-2">
                                
                                    <button class="btn btn-primary" type="submit"> Submit PIN</button>
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
