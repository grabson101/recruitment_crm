@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Companies') }}
                    <div>
                        <a class="btn btn-success px-4 py-2" href="{{route('companies.create')}}" role="button">NEW</i></a>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Logo</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($companies as $company)
                                <tr>
                                    <td>{{ $company->name }}</td>
                                    <td><img src="{{asset('storage/' . $company->logo)}}" alt=""></td>
                                    <td>
                                        <div class="actions">
                                            <a class="btn btn-success" href="{{route('companies.show', ['company' => $company->id])}}" role="button"><i class="bi bi-eye"></i></a>
                                            <a class="btn btn-info" href="{{route('companies.edit', ['company' => $company->id])}}" role="button"><i class="bi bi-pencil-square"></i></a>
                                            <form action="{{route('companies.destroy', ['company' => $company->id])}}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-danger" type="submit"><i class="bi bi-trash"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                      </table>
                      <div class="d-flex justify-content-center pt-4">
                        {!! $companies->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
