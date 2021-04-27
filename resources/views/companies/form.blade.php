@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Companies') }}</div>

                <div class="card-body">
                    
                    <form action="@if( Route::currentRouteName() == 'companies.create' ){{ route('companies.store') }} @else{{ route('companies.update', @$company->id) }}@endif" method="post" enctype="multipart/form-data">
                        @csrf
                        @if( Route::currentRouteName() == 'companies.edit' )
                            @method('put')
                        @endif
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" value="{{ old('name', @$company->name)  }}">
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="name">Website</label>
                            <input type="text" class="form-control" name="website" id="website" name="website" placeholder="Enter website" value="{{ old('website', @$company->website) }}">
                            @error('website')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Enter email" value="{{ old('email', @$company->email) }}">
                            @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="d-flex align-items-center mb-3">
                                <img src="{{ asset('storage/' . @$company->logo) }}" alt="">
                                <label class="m-0 pl-1" for="logo">Logo</label>
                            </div>
                            <input type="file" name="logo" class="form-control-file" id="logo">
                            @error('logo')
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
