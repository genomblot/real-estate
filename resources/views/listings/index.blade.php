@extends('layouts.app')

@section('content')
    <h1 class="text-4xl font-semibold mb-4 text-center">Список объявлений</h1>

    <div class="mb-4">
        <form action="{{ route('home') }}" method="GET" class="form-inline justify-content-center">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Поиск по объявлениям..." value="{{ request('search') }}">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-success">Поиск</button>
                </div>
            </div>
        </form>
    </div>

    <div class="row">
        @foreach ($listings as $listing)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h2 class="card-title">{{ $listing->title }}</h2>
                        <p class="card-text">Цена: {{ $listing->price }} руб.</p>
                        <p class="card-text">Метро: {{ $listing->metro_station }}</p>
                        <a href="{{ route('listings.show', $listing->id) }}" class="btn btn-primary mt-2">Подробнее</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    @if ($listings->isEmpty())
        <div class="alert alert-warning text-center">
            Объявления не найдены.
        </div>
    @endif
@endsection
