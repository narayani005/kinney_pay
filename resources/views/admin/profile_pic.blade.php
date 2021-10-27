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
    @if($data->profile_img != 'default.png')
    <img src="{{ url('assets/images/users/avatar-2.jpg')}}" alt="user profile pic" class="avatar-lg rounded-circle" /> 
    @else
    <br/><h4> Profile Pic Not Uploaded  </h4><br/>
    @endif
                                       
                        <form action="/ppic_submit" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <input type="hidden" name="id" value="{{ Auth()->user()->id  }}" />
                           
                            
                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-md-2 col-form-label"> Upload Profile Pic:</label>
                                <div class="col-md-4">
                                    <input class="form-control" name="profile_img" type="file"  required/>
                                </div>
                            </div> 
                                  
                            <div class="mb-3 row">
                                <label class="col-md-5 col-form-label"> </label>
                                <div class="col-md-2">
                                
                                    <button class="btn btn-primary" type="submit"> Upload Image</button>
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
