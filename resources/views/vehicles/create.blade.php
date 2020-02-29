@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="jumbotron">
                    <h3 class="display-4 mb-0" style="font-size:30px !important;">
                        <i class="far fa-plus"></i> Create New Vehicle
                    </h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('customers.index') }}">Customers</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('customers.show', $customer) }}">{{ $customer->first_name }} {{ $customer->last_name }}</a></li>
                            <li class="breadcrumb-item active">Create New Vehicle</li>
                        </ol>
                    </nav>
                </div>

                <div class="card">
                    <form action="{{ route('vehicles.store', $customer) }}" method="post" autocomplete="off">
                        @csrf
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="mb-3">
                                <span class="text-danger small">* Required</span>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-4">
                                    <label for="make">Make <small class="text-danger">*</small></label>
                                    <input type="text" class="form-control @error('make') is-invalid @enderror" name="make" id="make" placeholder="Make" value="{{ old('make') }}" autocomplete="off" required>
                                    @error('make')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-4">
                                    <label for="model">Model <small class="text-danger">*</small></label>
                                    <input type="text" class="form-control @error('model') is-invalid @enderror" name="model" id="model" placeholder="Model" value="{{ old('model') }}" autocomplete="off" required>
                                    @error('model')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-4">
                                    <label for="year">Year</label>
                                    <input type="text" class="form-control @error('year') is-invalid @enderror" name="year" id="year" placeholder="Year" value="{{ old('year') }}" autocomplete="off">
                                    @error('year')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-4">
                                    <label for="mileage">Current Mileage</label>
                                    <input type="text" class="form-control @error('color') is-invalid @enderror" name="mileage" id="mileage" placeholder="Mileage" value="{{ old('mileage') }}" autocomplete="off">
                                    @error('mileage')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-4">
                                    <label for="color">Color</label>
                                    <input type="text" class="form-control @error('color') is-invalid @enderror" name="color" id="color" placeholder="Color" value="{{ old('color') }}" autocomplete="off">
                                    @error('color')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-4">
                                    <label for="body_type">Body Type</label>
                                    <input type="text" class="form-control @error('body_type') is-invalid @enderror" name="body_type" id="body_type" placeholder="Body Type" value="{{ old('body_type') }}" autocomplete="off">
                                    @error('body_type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="license_plate">License Plate</label>
                                    <input type="text" class="form-control @error('license_plate') is-invalid @enderror" name="license_plate" id="license_plate" placeholder="License Plate" value="{{ old('license_plate') }}" autocomplete="off">
                                    @error('license_plate')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="vin">VIN</label>
                                    <input type="text" class="form-control @error('vin') is-invalid @enderror" name="vin" id="vin" placeholder="VIN" value="{{ old('vin') }}" autocomplete="off">
                                    @error('vin')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-12">
                                    <label for="comments">Comments</label>
                                    <textarea name="comments" id="comments" cols="30" rows="5" class="form-control @error('comments') is-invalid @enderror">{{ old('comments') }}</textarea>
                                    @error('comments')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="form-group mb-0 text-right">
                                <button type="submit" class="btn btn-success"><i class="far fa-check"></i> Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
