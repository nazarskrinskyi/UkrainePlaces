@extends('adminlte::page')

@section('title', 'Contact Us')

@section('content_header')
    <h1>Зворотній зв'язок</h1>
@endsection

@section('content')
    <h1>Зворотній зв'язок</h1>
    <table class="table">
        <thead>
        <tr>
            <th>Username</th>
            <th>Email</th>
            <th>Created At</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($contactUsEntries as $entry)
            <tr>
                <td>{{ $entry->username }}</td>
                <td>{{ $entry->email }}</td>
                <td>{{ $entry->created_at }}</td>
                <td>
                    <!-- Show Button -->
                    <a href="{{ route('contact-us.show', $entry->id) }}" class="btn btn-info">Show</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
