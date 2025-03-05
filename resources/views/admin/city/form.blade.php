@extends('adminlte::page')

@section('title', 'Cities')

@section('content_header')
    <h1>{{ isset($city) ? 'Редагування міста' : 'Створення міста' }}</h1>
@endsection

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ isset($city) ? 'Редагувати місто' : 'Створити місто' }}</h3>
        </div>

        <form action="{{ isset($city) ? route('admin.city.update', $city) : route('admin.city.store') }}" method="POST">
            @csrf
            @if(isset($city))
                @method('PUT')
            @endif

            <div class="card-body">

                <div class="form-group">
                    <label for="name">Назва міста</label>
                    <input type="text"
                           name="name"
                           id="name"
                           value="{{ old('name', $city->name ?? '') }}"
                           class="form-control @error('name') is-invalid @enderror"
                           placeholder="Введіть назву міста">
                    @error('name')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="code">Код міста</label>
                    <input type="text"
                           name="code"
                           id="code"
                           value="{{ old('code', $city->code ?? '') }}"
                           class="form-control @error('code') is-invalid @enderror"
                           placeholder="Введіть код міста">
                    @error('code')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="code">Координати міста</label>
                    <textarea type="text"
                           name="coordinates"
                           id="coordinates"
                           class="form-control @error('coordinates') is-invalid @enderror"
                           placeholder="Введіть координати міста">{{ old('coordinates', $city->coordinates ?? '') }}</textarea>
                    @error('coordinates')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary">
                    {{ isset($city) ? 'Оновити' : 'Створити' }}
                </button>
            </div>
        </form>
    </div>

@endsection
