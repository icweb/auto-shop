@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="jumbotron">
                    <h3 class="display-4 mb-0" style="font-size:30px !important;">
                        <i class="far fa-user"></i> {{ $customer->first_name }} {{ $customer->last_name }}
                        <div class="float-right">
                            <a href="{{ route('customers.edit', $customer) }}" class="btn btn-warning btn-sm"><i class="far fa-pencil"></i></a>
                            <a href="" class="btn btn-danger btn-sm"><i class="far fa-trash"></i></a>
                        </div>
                    </h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('customers.index') }}">Customers</a></li>
                            <li class="breadcrumb-item active">{{ $customer->first_name }} {{ $customer->last_name }}</li>
                        </ol>
                    </nav>
                </div>

                <div class="card mb-4">
                    <div>
                        <table class="table mb-0">
                            <tbody>
                                <tr>
                                    <td style="width: 150px;"><b><i class="far fa-mobile-android fa-fw"></i> Mobile Phone</b></td>
                                    <td>{{ $customer->mobile_phone }}</td>
                                </tr>
                                <tr>
                                    <td><b><i class="far fa-phone fa-fw"></i> Home Phone</b></td>
                                    <td>{{ $customer->home_phone }}</td>
                                </tr>
                                <tr>
                                    <td><b><i class="far fa-envelope-open fa-fw"></i> Email</b></td>
                                    <td><a href="mailto:{{ $customer->email }}">{{ $customer->email }}</a></td>
                                </tr>
                                <tr>
                                    <td><b><i class="far fa-comments fa-fw"></i> Comments</b></td>
                                    <td>{{ $customer->comments }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header bg-dark text-white">
                        <i class="far fa-cars"></i> Vehicles
                    </div>
                    <div class="card-body">
                        <table class="table mb-0 dt-table">
                            <thead>
                                <tr>
                                    <th>Year</th>
                                    <th>Make</th>
                                    <th>Model</th>
                                    <th>Color</th>
                                    <th>Last Seen</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($customer->vehicles as $vehicle)
                                    <tr>
                                        <td>{{ $vehicle->year }}</td>
                                        <td>{{ $vehicle->make }}</td>
                                        <td>{{ $vehicle->model }}</td>
                                        <td>{{ $vehicle->color }}</td>
                                        <td>{{ $vehicle->last_seen }}</td>
                                        <td class="text-right">
                                            <a href="{{ route('vehicles.show', $vehicle) }}" class="btn btn-sm btn-info text-white"><i class="far fa-folder-open"></i> View</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card mb-5">
                    <div class="card-header bg-dark text-white">
                        <i class="far fa-calendar"></i> Appointments
                    </div>
                    <div>

                    </div>
                </div>

                <div class="card mb-5">
                    <div class="card-header bg-dark text-white">
                        <i class="far fa-folders"></i> Rendered Services
                    </div>
                    <div class="card-body">
                        <table class="table mb-0 dt-table">
                            <thead>
                                <tr>
                                    <th>What</th>
                                    <th>When</th>
                                    <th>Who</th>
                                    <th>Cost</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($customer->renderedServices as $renderedService)
                                    <tr>
                                        <td>{{ $renderedService->service->name }}</td>
                                        <td>{{ $renderedService->completed_at === null ? 'Never' : $renderedService->completed_at->format('m/d/Y') }}</td>
                                        <td>{{ $renderedService->employee->name }}</td>
                                        <td>{{ $renderedService->cost }}</td>
                                        <td class="text-right">
                                            <a href="#" class="btn btn-sm btn-info text-white"><i class="far fa-folder-open"></i> View</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
