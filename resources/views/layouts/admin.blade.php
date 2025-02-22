@extends('adminlte::page')

@section('title', 'Admin Panel')

@section('content_header')
    <h1>Dashboard</h1>
@endsection

@section('content')
    @yield('admin-content')
@endsection
