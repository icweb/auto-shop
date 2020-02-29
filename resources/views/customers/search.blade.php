@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="jumbotron">
                    <h3 class="display-4 mb-0" style="font-size:30px !important;">
                        <i class="far fa-search"></i> Search Customers
                    </h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Search Customers</li>
                        </ol>
                    </nav>
                </div>

                <div class="card mb-4">
                    <form action="{{ route('customers.search') }}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-6">
                                    <label for="first_name">First Name</label>
                                    <input type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" id="first_name" placeholder="First Name" value="{{ $criteria['first_name'] ?? '' }}" autocomplete="off">
                                    @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" id="last_name" placeholder="Last Name" value="{{ $criteria['last_name'] ?? '' }}" autocomplete="off">
                                    @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="home_phone">Home Phone</label>
                                    <input type="text" class="form-control @error('home_phone') is-invalid @enderror" name="home_phone" id="home_phone" placeholder="Home Phone" value="{{ $criteria['home_phone'] ?? '' }}" autocomplete="off">
                                    @error('home_phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="mobile_phone">Mobile Phone</label>
                                    <input type="text" class="form-control @error('mobile_phone') is-invalid @enderror" name="mobile_phone" id="mobile_phone" placeholder="Mobile Phone" value="{{ $criteria['mobile_phone'] ?? '' }}" autocomplete="off">
                                    @error('mobile_phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-12">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Email" value="{{ $criteria['email'] ?? '' }}" autocomplete="off">
                                    @error('email')
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

                @if(isset($customers))
                    <div class="alert alert-info">
                        {{ count($customers) }} customers(s) found
                    </div>

                    @if(count($customers) > 0)
                        <div class="card">
                            <div class="card-body">
                                @include('customers.partial-index-table', ['customers' => $customers])
                            </div>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
@endsection
