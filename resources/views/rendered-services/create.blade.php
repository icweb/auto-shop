@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="jumbotron">
                    <h3 class="display-4 mb-0" style="font-size:30px !important;">
                        <i class="far fa-plus"></i> Create New Rendered Service
                    </h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('customers.index') }}">Customers</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('customers.show', $customer) }}">{{ $customer->first_name }} {{ $customer->last_name }}</a></li>
                            <li class="breadcrumb-item active">Create New Rendered Service</li>
                        </ol>
                    </nav>
                </div>

                <div class="card">
                    <form action="{{ route('rendered-services.store', $customer) }}" method="post" autocomplete="off">
                        @csrf
                        <input type="hidden" name="source" id="source" value="{{ $_GET['source'] ?? 'customer' }}" data-og="{{ $_GET['source'] ?? 'customer' }}">
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
                                <div class="form-group col-6">
                                    <label for="service">Service <small class="text-danger">*</small></label>
                                    <select name="service" id="service" class="form-control @error('service') is-invalid @enderror" required onchange="$('#cost').val($('#service option:selected').attr('data-cost'))">
                                        <option value="" data-cost="0.00">Select One</option>
                                        @foreach($services as $service)
                                            <option value="{{ $service->id }}" {{ (old("service") == $service->id ? "selected" : "") }} data-cost="{{ $service->cost }}">{{ $service->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('service')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="vehicle">Vehicle <small class="text-danger">*</small></label>
                                    <select name="vehicle" id="vehicle" class="form-control @error('vehicle') is-invalid @enderror" required>
                                        <option value="">Select One</option>
                                        @foreach($vehicles as $vehicle)
                                            @if(old("vehicle") == $vehicle->id)
                                                <option value="{{ $vehicle->id }}" selected>{{ $vehicle->make . ' ' . $vehicle->model }}</option>
                                            @elseif(isset($_GET['v']) && $_GET['v'] == $vehicle->id)
                                                <option value="{{ $vehicle->id }}" selected>{{ $vehicle->make . ' ' . $vehicle->model }}</option>
                                            @else
                                                <option value="{{ $vehicle->id }}">{{ $vehicle->make . ' ' . $vehicle->model }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('vehicle')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-4">
                                    <label for="cost">Cost</label>
                                    <input type="text" class="form-control @error('cost') is-invalid @enderror" name="cost" id="cost" placeholder="Cost" value="{{ old('cost') }}" autocomplete="off">
                                    @error('cost')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-4">
                                    <label for="completed_at">Completed At</label>
                                    <input type="date" class="form-control @error('completed_at') is-invalid @enderror" name="completed_at" id="completed_at" placeholder="Completed At" value="{{ old('completed_at') }}" autocomplete="off">
                                    @error('completed_at')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-4">
                                    <label for="employee">Employee</label>
                                    <select name="employee" id="employee" class="form-control @error('employee') is-invalid @enderror">
                                        <option value="">Select One</option>
                                        @foreach($employees as $employee)
                                            <option value="{{ $employee->id }}" {{ (old("employee") == $employee->id ? "selected" : "") }}>{{ $employee->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('employee')
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
                                <div class="form-group col-12">
                                    <label for=""><input type="checkbox" id="stay-on-page" onchange="$('#stay-on-page').is(':checked') ? $('#source').val('form') : $('#source').val($('#source').attr('data-og'))"> Enter another rendered service</label>
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
