@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Employees') }}</div>

                <div class="card-body">
                    <div class="content">
                        <p>
                            <b>First name:</b> {{ $employee->first_name }}
                        </p>
                        <p>
                            <b>Last name:</b> {{ $employee->last_name }}
                        </p>
                        <p>
                            <b>E-mail: </b> <a href="mailto:{{ $employee->email }}">{{$employee->email}}</a> 
                        </p>
                        <p>
                            <b>Phone:</b> {{ $employee->phone }}
                        </p>
                        <p>
                            <b>Company: </b> <a href="{{ route('companies.show', ['company' => $employee->company->id]) }}">{{ $employee->company->name }}</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
