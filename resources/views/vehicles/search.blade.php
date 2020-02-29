@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="jumbotron">
                    <h3 class="display-4 mb-0" style="font-size:30px !important;">
                        <i class="far fa-search"></i> Search Vehicles
                    </h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Search Vehicles</li>
                        </ol>
                    </nav>
                </div>

                <div class="card mb-4">
                    <form action="{{ route('vehicles.search') }}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-4">
                                    <label for="make">Make</label>
                                    <select name="make" id="make" class="form-control">
                                        <option value="">All</option>
                                        @foreach($makes as $make)
                                            <option value="{{ $make }}" {{ ($criteria['make'] == $make ? "selected" : "") }}>{{ $make }}</option>
                                        @endforeach
                                    </select>
                                    @error('make')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-4">
                                    <label for="model">Model</label>
                                    <select name="model" id="model" class="form-control">
                                        <option value="">All</option>
                                        @foreach($models as $model)
                                            <option value="{{ $model }}" {{ ($criteria['model'] == $model ? "selected" : "") }}>{{ $model }}</option>
                                        @endforeach
                                    </select>
                                    @error('make')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-4">
                                    <label for="year">Year</label>
                                    <input type="text" class="form-control @error('year') is-invalid @enderror" name="year" id="year" placeholder="Year" value="{{ $criteria['year'] ?? '' }}" autocomplete="off">
                                    @error('year')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="color">Color</label>
                                    <select name="color" id="color" class="form-control">
                                        <option value="">All</option>
                                        @foreach($colors as $color)
                                            <option value="{{ $color }}" {{ ($criteria['color'] == $color ? "selected" : "") }}>{{ $color }}</option>
                                        @endforeach
                                    </select>
                                    @error('color')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="body_type">Body Type</label>
                                    <select name="body_type" id="body_type" class="form-control">
                                        <option value="">All</option>
                                        @foreach($body_types as $body_type)
                                            <option value="{{ $body_type }}" {{ ($criteria['body_type'] == $body_type ? "selected" : "") }}>{{ $body_type }}</option>
                                        @endforeach
                                    </select>
                                    @error('body_type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="license_plate">License Plate</label>
                                    <input type="text" class="form-control @error('license_plate') is-invalid @enderror" name="license_plate" id="license_plate" placeholder="License Plate" value="{{ $criteria['license_plate'] ?? '' }}" autocomplete="off">
                                    @error('license_plate')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="vin">VIN</label>
                                    <input type="text" class="form-control @error('vin') is-invalid @enderror" name="vin" id="vin" placeholder="VIN" value="{{ $criteria['vin'] ?? '' }}" autocomplete="off">
                                    @error('vin')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="form-group mb-0 text-right">
                                <button type="submit" class="btn btn-success"><i class="far fa-search"></i> Search</button>
                            </div>
                        </div>
                    </form>
                </div>

                @if(isset($vehicles))
                    <div class="alert alert-info">
                        {{ count($vehicles) }} vehicle(s) found
                    </div>

                    @if(count($vehicles) > 0)
                        <div class="card">
                            <div class="card-body">
                                @include('vehicles.partial-index-table', ['vehicles' => $vehicles])
                            </div>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
@endsection
