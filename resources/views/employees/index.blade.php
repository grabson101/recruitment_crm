@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"> 
                    {{ $company->name ?? '' }}
                    {{ __('Employees') }}
                    <div>
                        <a class="btn btn-success px-4 py-2" href="{{ isset($company) ? route('employees.create', ['company' => $company->id]) : route('employees.create')}}" role="button">NEW</i></a>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">First name</th>
                                <th scope="col">Last name</th>
                                <th scope="col">Company</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employees as $employee)
                                <tr>
                                    <td>{{ $employee->first_name }}</td>
                                    <td>{{ $employee->last_name }}</td>
                                    <td><a href="{{ route('companies.show', ['company' => $employee->company->id]) }}">{{ $employee->company->name }}</a></td>
                                    <td>
                                        <div class="actions">
                                            <a class="btn btn-success" href="{{route('employees.show', ['employee' => $employee->id])}}" role="button"><i class="bi bi-eye"></i></a>
                                        <a class="btn btn-info" href="{{route('employees.edit', ['employee' => $employee->id])}}" role="button"><i class="bi bi-pencil-square"></i></a>
                                        <form action="{{route('employees.destroy', ['employee' => $employee->id])}}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger" type="submit"><i class="bi bi-trash"></i></button>
                                        </form>
                                        </div>
                                    </td>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                      </table>
                      <div class="d-flex justify-content-center pt-4">
                        {!! $employees->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
