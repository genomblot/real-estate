<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreListingRequest;
use App\Models\Listing;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $listings = Listing::when($search, function ($query, $search) {
            $query->where('title', 'like', "%$search%")
                  ->orWhere('description', 'like', "%$search%");
        })->get();

        return view('listings.index', compact('listings'));
    }

    public function create()
    {
        return view('listings.create');
    }

    public function store(StoreListingRequest $request)
    {
        $validatedData = $request->validated();

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('public/photos'); // Файл будет сохранен в storage/app/public/photos
            $validatedData['photo'] = str_replace('public/', '', $path); // Сохраняем только путь относительно public
        }

        $listing = auth()->user()->listings()->create($validatedData);
        return redirect()->route('listings.show', $listing->id);
    }

    public function show($id)
    {
        $listing = Listing::findOrFail($id);
        return view('listings.show', compact('listing'));
    }

    public function update(StoreListingRequest $request, Listing $listing)
    {
        $validatedData = $request->validated();

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('public/photos'); // Сохраняем новый файл
            $validatedData['photo'] = str_replace('public/', '', $path); // Обновляем путь к фотографии
        }

        $listing->update($validatedData);
        return redirect()->route('listings.show', $listing->id);
    }

    public function destroy(Listing $listing)
    {
        if ($listing->user_id !== auth()->id()) {
            abort(403, 'Вы не авторизованы для удаления этого объявления.');
        }

        $listing->delete();

        return redirect()->route('listings.index')->with('success', 'Объявление успешно удалено.');
    }

    public function edit(Listing $listing)
    {
        // Проверка авторизации: убедитесь, что текущий пользователь является владельцем объявления
        if ($listing->user_id !== auth()->id()) {
            abort(403, 'Вы не авторизованы для редактирования этого объявления.');
        }

        return view('listings.edit', compact('listing'));
    }
}