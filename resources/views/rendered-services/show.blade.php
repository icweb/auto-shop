@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="jumbotron">
                    <h3 class="display-4 mb-0" style="font-size:30px !important;">
                        <i class="far fa-folders"></i> {{ $renderedService->service->name }}
                        <div class="float-right">
                            <a href="#" class="btn btn-warning btn-sm"><i class="far fa-pencil"></i></a>
                            <a href="" class="btn btn-danger btn-sm"><i class="far fa-trash"></i></a>
                        </div>
                    </h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('customers.index') }}">Customers</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('customers.show', $customer) }}">{{ $customer->first_name }} {{ $customer->last_name }}</a></li>
                            <li class="breadcrumb-item active">{{ $renderedService->service->name  }}</li>
                        </ol>
                    </nav>
                </div>
                <div class="card mb-4">
                    <div>
                        <table class="table mb-0">
                            <tbody>
                                <tr>
                                    <td style="width: 150px;"><b><i class="far fa-folder fa-fw"></i> Service</b></td>
                                    <td>{{ $renderedService->service->name }}</td>
                                </tr>
                                <tr>
                                    <td><b><i class="far fa-money-bill-wave fa-fw"></i> Cost</b></td>
                                    <td>${{ $renderedService->cost ?? '0.00' }}</td>
                                </tr>
                                <tr>
                                    <td><b><i class="far fa-calendar fa-fw"></i> Completed At</b></td>
                                    <td>{{ $renderedService->completed_at === null ? 'Never' : $renderedService->completed_at->format('m/d/Y') }}</td>
                                </tr>
                                <tr>
                                    <td><b><i class="far fa-car fa-fw"></i> Vehicle</b></td>
                                    <td><a href="{{ route('vehicles.show', $renderedService->vehicle) }}">{{ $renderedService->vehicle->make . ' ' . $renderedService->vehicle->model  }}</a></td>
                                </tr>
                                <tr>
                                    <td><b><i class="far fa-user fa-fw"></i> Customer</b></td>
                                    <td><a href="{{ route('customers.show', $customer) }}">{{ $customer->first_name . ' ' . $customer->last_name }}</a></td>
                                </tr>
                                <tr>
                                    <td><b><i class="far fa-user-tie fa-fw"></i> Employee</b></td>
                                    <td>{{ $renderedService->employee ? $renderedService->employee->name : '' }}</td>
                                </tr>
                                <tr>
                                    <td><b><i class="far fa-comments fa-fw"></i> Comments</b></td>
                                    <td>{{ $renderedService->comments }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
