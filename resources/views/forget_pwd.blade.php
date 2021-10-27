@extends('layouts.login_base')

@section('title')
    Add User
@endsection

@section('page_name')
    Add User 
@endsection

@section('content')

            <div class="card">
                <div class="card-body">

                    <div class="auth-logo">
                        <h3 class="text-center">
                            <a href="index.html" class="logo d-block my-4">
                                <img src="{{ asset('assets/images/logo-dark.png')}}" class="logo-dark mx-auto" height="30" alt="logo-dark">
                                <img src="{{ asset('assets/images/logo-light.png')}}" class="logo-light mx-auto" height="30" alt="logo-light">
                            </a>
                        </h3>
                    </div>

                    <div class="p-3">
                        <h4 class="text-muted font-size-18 mb-3 text-center">Reset Password</h4>
                        <div class="alert alert-info" role="alert">
                            Enter your Email and instructions will be sent to you!
                        </div>

                        <form class="form-horizontal" action="#">

                            <div class="mb-3">
                                <label class="form-label" for="useremail">Email</label>
                                <input type="email" class="form-control" id="useremail" placeholder="Enter email">
                            </div>

                            <div class="mb-3 row">
                                <div class="col-12 text-end">
                                    <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Reset</button>
                                </div>
                            </div>

                        </form>
                    </div>

                </div>
            </div>

            


@endsection

@section('acc_avail')
    Remember It ? <a href="{{ url('/register') }}" class="text-white"> Sign In Here  </a>
@endsection