@extends('adminlte::page')

@section('title', 'Cities')

@section('content_header')
    <h1>Регіони</h1>
@endsection

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="{{ route('admin.city.create') }}" class="btn btn-primary">Create City</a>
        </div>

        @if($cities->count())
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Code</th>
                    <th class="text-end">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($cities as $city)
                    <tr>
                        <td>{{ $city->id }}</td>
                        <td>{{ $city->name }}</td>
                        <td>{{ $city->code }}</td>
                        <td class="text-end">
                            <a href="{{ route('admin.city.edit', $city->id) }}" class="btn btn-sm btn-warning">Edit</a>

                            <form action="{{ route('admin.city.delete', $city->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <p>No cities found.</p>
        @endif
    </div>
@endsection
