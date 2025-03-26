@extends('layouts.app')

@section('content')
    <h1>Редактировать объявление</h1>
    <form method="POST" action="{{ route('listings.update', $listing->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Заголовок</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $listing->title }}" required>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Цена</label>
            <input type="number" class="form-control" id="price" name="price" value="{{ $listing->price }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Описание</label>
            <textarea class="form-control" id="description" name="description" rows="3" required>{{ $listing->description }}</textarea>
        </div>

        <div class="mb-3">
            <label for="metro_station" class="form-label">Станция метро</label>
            <input type="text" class="form-control" id="metro_station" name="metro_station" value="{{ $listing->metro_station }}">
        </div>

        <div class="mb-3">
            <label for="photo" class="form-label">Фотография</label>
            @if ($listing->photo)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $listing->photo) }}" alt="{{ $listing->title }}" class="img-thumbnail" style="max-width: 200px;">
                </div>
            @endif
            <input type="file" class="form-control" id="photo" name="photo">
            @error('photo')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <small class="form-text text-muted">Оставьте поле пустым, если не хотите изменять фотографию.</small>
        </div>

        <button type="submit" class="btn btn-primary">Сохранить изменения</button>
        <a href="{{ route('listings.show', $listing->id) }}" class="btn btn-secondary">Отмена</a>
    </form>
@endsection