@extends('adminlte::page')

@section('title', 'Contact Us Details')

@section('content_header')
    <h1>Зворотній зв'язок - Деталі</h1>
@endsection

@section('content')
    <h1>Зворотній зв'язок - Деталі</h1>

    <div class="card">
        <div class="card-body">
            <h4><strong>Username:</strong> {{ $contactUsEntry->username }}</h4>
            <h4><strong>Email:</strong> {{ $contactUsEntry->email }}</h4>
            <h4><strong>Content:</strong> {{ $contactUsEntry->content }}</h4>
            <h4><strong>Created At:</strong> {{ $contactUsEntry->created_at }}</h4>
        </div>
    </div>

    <a href="{{ route('contact-us.index') }}" class="btn btn-primary mt-3">Back to List</a>
@endsection
