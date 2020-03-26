@extends('layouts.app')

@section('header')
    <style type="text/css">
        .card {
            border-top: 10px solid {{ $appointment->color }};
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="jumbotron">
                    <h3 class="display-4 mb-0" style="font-size:30px !important;">
                        <i class="far fa-user"></i> {{ $appointment->starts_at->format('F d, Y') }}
                        <div class="float-right">
                            <a href="" class="btn btn-info btn-sm"><i class="far fa-file-invoice-dollar"></i></a>
                            <a href="{{ route('appointments.edit', $appointment) }}" class="btn btn-warning btn-sm"><i class="far fa-pencil"></i></a>
                            <a href="" class="btn btn-danger btn-sm"><i class="far fa-trash"></i></a>
                        </div>
                    </h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('appointments.index') }}">Schedule</a></li>
                            <li class="breadcrumb-item active">{{ $appointment->starts_at->format('F d, Y') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="col-6">
                <div class="card mb-4 h-100">
                    <div>
                        <table class="table mb-0">
                            <tbody>
                                <tr>
                                    <td style="width: 150px;"><b><i class="far fa-clock fa-fw"></i> Start</b></td>
                                    <td>{{ $appointment->starts_at->format('m/d/Y H:i a') }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 150px;"><b><i class="far fa-clock fa-fw"></i> End</b></td>
                                    <td>{{ $appointment->ends_at->format('m/d/Y H:i a') }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 150px;"><b><i class="far fa-user fa-fw"></i> Customer</b></td>
                                    <td>{{ $appointment->customer->name }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 150px;"><b><i class="far fa-user-tie fa-fw"></i> Author</b></td>
                                    <td>{{ $appointment->author->name }}</td>
                                </tr>
                                <tr>
                                    <td><b><i class="far fa-comments fa-fw"></i> Comments</b></td>
                                    <td>{{ $appointment->comments }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card mb-4 h-100">
                    <div class="card-body">
                        <b>Services</b><br>
                        <table class="table mb-o">
                            @include('rendered-services.partial-index-table', ['renderedServices' => $appointment->services, 'showVehicle' => true, 'showExpanded' => false, 'dataTable' => false, 'dataTable' => false])
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
