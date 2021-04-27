@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Employees') }}</div>

                <div class="card-body">
                    <form action="@if( Route::currentRouteName() == 'employees.create' ){{ route('employees.store') }} @else{{ route('employees.update', @$employee->id) }}@endif" method="post" >
                        @csrf
                        @if( Route::currentRouteName() == 'employees.edit' )
                            @method('put')
                        @endif
                        <div class="form-group">
                            <label for="company_id">Company select</label>
                            <select class="form-control" name="company_id">
                                @foreach ($companies as $company)
                                    <option value="{{ $company->id }}" @if (old('company_id') == $company->id || @$employee->company_id == $company->id || @$requestCompany->id == $company->id )
                                        selected
                                    @endif>
                                        {{ $company->name }}
                                    </option>
                                @endforeach
                              
                            </select>
                          </div>
                        <div class="form-group">
                            <label for="first_name">First name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter name" value="{{ old('first_name', @$employee->first_name) }}">
                            @error('first_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="last_name">Last name</label>
                            <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Enter last name" value="{{ old('last_name', @$employee->last_name) }}">
                            @error('last_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Enter email" value="{{ old('email', @$employee->email) }}">
                            @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="tel" class="form-control" name="phone" id="phone" placeholder="Enter phone" value="{{ old('phone', @$employee->phone) }}">
                            @error('phone')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button class="btn btn-success px-5 py-2 mt-3 float-right" type="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
