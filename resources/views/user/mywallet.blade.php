@extends('layouts.layout')

@section('title')
    Wallet History
@endsection

@section('page_name')
    Wallet History 
@endsection

@section('content')
<div class="page-content-wrapper">
<div class="row">

        @forelse($datas as $data)
                                <div class="col-xl-3 col-md-6">
                                    <div class="card bg-primary mini-stat position-relative">
                                        <div class="card-body">
                                            <div class="mini-stat-desc">
                                                <h5 class="text-uppercase verti-label font-size-16 text-white-50">Wallet
                                                </h5>
                                                
                                                <div class="text-white">
                                                    <h5 class="text-uppercase font-size-16 text-white-50"> Trans ID : {{ $data->trans_id }} </h5>
                                                    <h3 class="mb-3 text-white">{{ $data->trans_amt }}</h3>
                                                    <div class="">
                                                    <!--a href=""><h4><span class="badge bg-dark">  Share </span></h4> </a--> 
                                                    
                                                    <h5 class="text-uppercase font-size-16 text-white"> 
                                                        @if($data->trans_by_id == $data->trans_to_id && Auth()->user()->id == $data->trans_by_id)
                                                            {{ $data->status }} By Self (@if($data->trans_type == 'kinney_plus') Kinney Plus @elseif($data->trans_type == 'kinney_vpo') Kinney VPO @else   @endif)
                                                        @elseif(Auth()->user()->id == $data->trans_by_id)
                                                            Transferred To {{ $data->trans_to_name }}
                                                        @elseif(Auth()->user()->id == $data->trans_to_id)
                                                            Credited By {{ $data->trans_by_name }}
                                                        @else

                                                        @endif
                                                        
                                                    </h5> 
                                                    <h5 class="text-uppercase font-size-10 text-white-50"> On {{ $data->trans_on }}</h5>
                                                    <h5 class="text-uppercase font-size-16 text-white-50"> Status {{ $data->status }}</h5> 
                                                    </div>
                                                </div>
                                                
                                                <div class="mini-stat-icon">
                                                    <i class="mdi mdi-cube-outline display-2"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @empty
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="auth-logo">
                        <h3 class="text-center">
                            <a href="/" class="logo d-block my-4">
                                <img src="{{ asset('assets/images/kinneypaylogo.png') }}" class="logo-dark mx-auto" height="100" alt="logo-dark">
                                <img src="{{ asset('assets/images/kinneypaylogo.png') }}" class="logo-light mx-auto" height="100" alt="logo-light">
                            </a>
                        </h3>
                </div>
                <div class="card-body">

                    <center><h3> Transaction history is Empty </h3></center>

                </div>
            </div>
        </div>
    </div>
</div>
                                @endforelse
                            
                           
                           


















                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection