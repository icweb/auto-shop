@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="jumbotron">
                    <h3 class="display-4 mb-0" style="font-size:30px !important;">
                        <i class="far fa-user"></i> {{ $appointment->starts_at->format('F d, Y') }}
                        <div class="float-right">
                            <a href="{{ route('appointments.edit', $appointment) }}" class="btn btn-warning btn-sm"><i class="far fa-pencil"></i></a>
                            <a href="" class="btn btn-danger btn-sm"><i class="far fa-trash"></i></a>
                        </div>
                    </h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('appointments.index') }}">Schedule</a></li>
                            <li class="breadcrumb-item" href="{{ route('appointments.show', $appointment) }}">{{ $appointment->starts_at->format('F d, Y') }}</li>
                            <li class="breadcrumb-item active">Edit</li>
                        </ol>
                    </nav>
                </div>

                <div class="card">
                    <form action="{{ route('appointments.update', $appointment) }}" method="post" autocomplete="off">
                        @csrf
                        @method('PUT')
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
{{--                                <div class="form-group col-6">--}}
{{--                                    <label for="starts_at">Starts At <small class="text-danger">*</small></label>--}}
{{--                                    <input type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" id="first_name" placeholder="First Name" value="{{ old('first_name', $customer->first_name) }}" autocomplete="off" required>--}}
{{--                                    @error('first_name')--}}
{{--                                        <span class="invalid-feedback" role="alert">--}}
{{--                                            <strong>{{ $message }}</strong>--}}
{{--                                        </span>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}

                                <div class="form-group col-12">
                                    <label for="comments">Comments</label>
                                    <textarea name="comments" id="comments" cols="30" rows="5" class="form-control @error('comments') is-invalid @enderror">{{ old('comments', $appointment->comments) }}</textarea>
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
                                <a href="{{ route('appointments.show', $appointment) }}" class="btn btn-primary float-left"><i class="far fa-times"></i> Cancel</a>
                                <button type="submit" class="btn btn-success"><i class="far fa-check"></i> Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
