@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="jumbotron">
                    <h3 class="display-4 mb-0" style="font-size:30px !important;">
                        <i class="far fa-file-invoice-dollar"></i> All Invoices
                    </h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">All Invoices</li>
                        </ol>
                    </nav>
                </div>

                <div class="card">
                    <div class="card-header bg-dark text-white">Invoices</div>
                    <div class="card-body">
                        @include('Invoices.partial-index-table', ['invoices' => $invoices])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
