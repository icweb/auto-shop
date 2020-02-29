@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="jumbotron">
                    <h3 class="display-4 mb-0" style="font-size:30px !important;">
                        <i class="far fa-users"></i> All Customers
                    </h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">All Customers</li>
                        </ol>
                    </nav>
                </div>

                <div class="card">
                    <div class="card-header bg-dark text-white">Customers</div>
                    <div class="card-body">
                        @include('customers.partial-index-table', ['customers' => $customers])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
