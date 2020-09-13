@extends('layouts.app')

@section('content')
<div class="container">
    @if ($edit)
        {!! Form::open(['url' => 'employee/'.$data->id.'/edit', 'method' => 'PUT', 'id' => 'form']) !!}
    @else
        {!! Form::open(['url' => 'employee/create', 'id' => 'form']) !!}
    @endif
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('partials.messages')
            <div class="card">
                <div class="card-header">{{ __('Add New Employee') }}</div>

                <div class="card-body">
                    <div class="form-group row">
                        <label for="employeeNumber" class="col-md-4 col-form-label text-md-right">{{ __('Employee Number') }}</label>

                        <div class="col-md-6">
                            <input id="employeeNumber" type="text" class="form-control @error('employeeNumber') is-invalid @enderror" name="employeeNumber" value="{{ $edit ? $data->employeeNumber : old('employeeNumber') }}" required autocomplete="off" autofocus>

                            @error('employeeNumber')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="firstName" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>

                        <div class="col-md-6">
                            <input id="firstName" type="text" class="form-control @error('firstName') is-invalid @enderror" name="firstName" value="{{ $edit ? $data->firstName : old('firstName') }}" required autocomplete="off">

                            @error('firstName')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="lastName" class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>

                        <div class="col-md-6">
                            <input id="lastName" type="text" class="form-control @error('lastName') is-invalid @enderror" name="lastName" value="{{ $edit ? $data->lastName : old('lastName') }}" required autocomplete="off">

                            @error('lastName')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __($edit ? 'Update' : 'Create') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
