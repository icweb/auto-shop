@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="jumbotron">
                    <h3 class="display-4 mb-0" style="font-size:30px !important;">
                        <i class="far fa-cars"></i> All Vehicles
                    </h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">All Vehicles</li>
                        </ol>
                    </nav>
                </div>

                <div class="card">
                    <div class="card-header bg-dark text-white">Vehicles</div>
                    <div class="card-body">
                        <table class="table mb-0 dt-table">
                            <thead>
                            <tr>
                                <th>Customer</th>
                                <th>Year</th>
                                <th>Make</th>
                                <th>Model</th>
                                <th>Last Seen</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($vehicles as $vehicle)
                                <tr>
                                    <td><a href="{{ route('customers.show', $vehicle->customer) }}">{{ $vehicle->customer->first_name . ' ' . $vehicle->customer->last_name }}</a></td>
                                    <td>{{ $vehicle->year }}</td>
                                    <td>{{ $vehicle->make }}</td>
                                    <td>{{ $vehicle->model }}</td>
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
            </div>
        </div>
    </div>
@endsection
