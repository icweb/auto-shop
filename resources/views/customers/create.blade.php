@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="jumbotron">
                    <h3 class="display-4 mb-0" style="font-size:30px !important;">
                        <i class="far fa-plus"></i> Create New Customer
                    </h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Create New Customer</li>
                        </ol>
                    </nav>
                </div>

                <div class="card">
                    <form action="{{ route('customers.store') }}" method="post" autocomplete="off">
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
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-6">
                                    <label for="first_name">First Name <small class="text-danger">*</small></label>
                                    <input type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" id="first_name" placeholder="First Name" value="{{ old('first_name') }}" autocomplete="off" required>
                                    @error('first_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="last_name">Last Name <small class="text-danger">*</small></label>
                                    <input type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" id="last_name" placeholder="Last Name" value="{{ old('last_name') }}" autocomplete="off" required>
                                    @error('last_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="home_phone">Home Phone</label>
                                    <input type="text" class="form-control @error('home_phone') is-invalid @enderror" name="home_phone" id="home_phone" placeholder="Home Phone" value="{{ old('home_phone') }}" autocomplete="off">
                                    @error('home_phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="mobile_phone">Mobile Phone</label>
                                    <input type="text" class="form-control @error('mobile_phone') is-invalid @enderror" name="mobile_phone" id="mobile_phone" placeholder="Mobile Phone" value="{{ old('mobile_phone') }}" autocomplete="off">
                                    @error('mobile_phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-12">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Email" value="{{ old('email') }}" autocomplete="off">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="email_reminders">Email Reminders</label>
                                    <select name="email_reminders" id="email_reminders" class="form-control">
                                        <option value="0" {{ (old("email_reminders") == "0" ? "selected" : "") }}>No</option>
                                        <option value="1" {{ (old("email_reminders") == "1" ? "selected" : "") }}>Yes</option>
                                    </select>
                                    @error('email_reminders')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="sms_reminders">SMS Reminders</label>
                                    <select name="sms_reminders" id="sms_reminders" class="form-control @error('sms_reminders') is-invalid @enderror">
                                        <option value="0" {{ (old("sms_reminders") == "0" ? "selected" : "") }}>No</option>
                                        <option value="1" {{ (old("sms_reminders") == "1" ? "selected" : "") }}>Yes</option>
                                    </select>
                                    @error('sms_reminders')
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
