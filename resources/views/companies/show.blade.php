@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Companies') }}</div>

                <div class="card-body">
                    <div class="content">
                        <p>
                            <b>Name: </b> {{$company->name}}
                        </p>
                        <p>
                            <b>Website:</b> {{$company->website}}
                        </p>
                        <p>
                            <b>E-mail:</b> <a href="mailto:{{ $company->email }}">{{$company->email}}</a> 
                        </p>
                        <p>
                            <b>Logo:</b> <img src="{{ asset('storage/' . $company->logo) }}" alt="">
                        </p>
                    </div>
                    <a class="btn btn-success px-5 py-2 mt-3 float-right" href="{{ route('employees.index', ['company' => $company->id]) }}">Employees</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
