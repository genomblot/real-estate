@extends('layouts.app')

@section('content')
    <h1>{{ $listing->title }}</h1>
    <p>Цена: {{ $listing->price }} руб.</p>
    <p>Описание: {{ $listing->description }}</p>
    <p>Станция метро: {{ $listing->metro_station }}</p>

    @if ($listing->photo)
        <img src="{{ asset('storage/' . $listing->photo) }}" alt="Фото объявления">
    @else
        <p>Фотография отсутствует.</p>
    @endif

    <p>Добавлено: {{ $listing->created_at }}</p>

    @auth
        @if (auth()->id() === $listing->user_id)
            <a href="{{ route('listings.edit', $listing->id) }}" class="btn btn-primary">Редактировать</a>

            <form method="POST" action="{{ route('listings.destroy', $listing->id) }}" style="display:inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Удалить</button>
            </form>
        @endif
    @endauth
@endsection