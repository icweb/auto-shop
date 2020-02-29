@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="jumbotron">
                    <h3 class="display-4 mb-0" style="font-size:30px !important;">
                        <i class="far fa-car"></i> {{ $vehicle->make }} {{ $vehicle->model }}
                        <div class="float-right">
                            <a href="{{ route('vehicles.edit', [$vehicle->customer, $vehicle]) }}" class="btn btn-warning btn-sm"><i class="far fa-pencil"></i></a>
                            <a href="" class="btn btn-danger btn-sm"><i class="far fa-trash"></i></a>
                        </div>
                    </h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('vehicles.index') }}">Vehicles</a></li>
                            <li class="breadcrumb-item active">{{ $vehicle->make }} {{ $vehicle->model }}</li>
                        </ol>
                    </nav>
                </div>

                <div class="card mb-4">
                    <div>
                        <table class="table mb-0">
                            <tbody>
                                <tr>
                                    <td style="width: 150px;"><b><i class="far fa-user fa-fw"></i> Owner</b></td>
                                    <td><a href="{{ route('customers.show', $vehicle->customer) }}">{{ $vehicle->customer->first_name . ' ' . $vehicle->customer->last_name }}</a></td>
                                </tr>
                                <tr>
                                    <td style="width: 150px;"><b><i class="far fa-tachometer-slowest fa-fw"></i> Mileage</b></td>
                                    <td>{{ $vehicle->last_mileage }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 150px;"><b><i class="far fa-calendar fa-fw"></i> Year</b></td>
                                    <td>{{ $vehicle->year }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 150px;"><b><i class="far fa-palette fa-fw"></i> Color</b></td>
                                    <td>{{ $vehicle->color }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 150px;"><b><i class="far fa-car fa-fw"></i> Body</b></td>
                                    <td>{{ $vehicle->body_type }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 150px;"><b><i class="far fa-address-card fa-fw"></i> License Plate</b></td>
                                    <td>{{ $vehicle->license_plate }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 150px;"><b><i class="far fa-fingerprint fa-fw"></i> VIN</b></td>
                                    <td>{{ $vehicle->vin }}</td>
                                </tr>
                                <tr>
                                    <td><b><i class="far fa-comments fa-fw"></i> Comments</b></td>
                                    <td>{{ $vehicle->comments }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card mb-5">
                    <div class="card-header bg-dark text-white">
                        <a href="{{ route('rendered-services.create', $vehicle->customer) }}?source=vehicle&v={{ $vehicle->id }}" class="float-right text-white"><i class="far fa-plus"></i> New</a>
                        <i class="far fa-folders"></i> Rendered Services
                    </div>
                    <div class="card-body">
                        @include('rendered-services.partial-index-table', ['renderedServices' => $vehicle->renderedServices, 'showVehicle' => false])
                    </div>
                </div>

                @if(\App\Setting::check('vehicle_show_mileage_history'))
                    <div class="card mb-5">
                        <div class="card-header bg-dark text-white">
                            <i class="far fa-tachometer-slowest"></i> Mileage History
                        </div>
                        <div class="card-body">
                            <table class="table mb-0 dt-table">
                                <thead>
                                <tr>
                                    <th>When</th>
                                    <th>Who</th>
                                    <th>Mileage</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($vehicle->mileage as $mileage)
                                    <tr>
                                        <td>{{ $mileage->created_at->format('m/d/Y') }}</td>
                                        <td>{{ $mileage->author->name }}</td>
                                        <td>{{ $mileage->mileage }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
