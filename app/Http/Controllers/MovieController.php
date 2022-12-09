<?php

namespace App\Http\Controllers;

use App\Http\Requests\RateRequest;
use App\Models\Movie;
use App\Models\Category;
use App\Traits\ImageTrait;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreMovieRequest;
use App\Http\Requests\UpdateMovieRequest;

class MovieController extends Controller
{
    use ImageTrait;

    public function __construct()
    {
        $this->middleware(['permission:movies-create'])->only(['create', 'store']);
        $this->middleware(['permission:movies-update'])->only(['edit', 'update']);
        $this->middleware(['permission:movies-delete'])->only('destroy');
    } //end of constructor


    public function index()
    {
        $movies = Movie::with('categories')->latest()->paginate(6);
        return view('movies.index', compact('movies'));
    } //end of index


    public function create()
    {
        $categories = Category::select('id', 'title')->get();
        return view('movies.create', compact('categories'));
    } //end of create


    public function store(StoreMovieRequest $request)
    {
        $movies_data = $request->except(['image', 'categories_ids']);
        $movies_data['user_id'] = Auth::id();
        if ($request->image) {
            $movies_data['image'] = $this->uploadImage($request->image, 'images/movies');
        }
        $movie = Movie::create($movies_data);
        $movie->categories()->sync($request->categories_ids);
        session()->flash('success', __('Movie created successfully'));
        return redirect()->route('movies.index');
    }


    public function rate(Movie $movie, RateRequest $request)
    {
        $movie->usersRates()->attach([Auth::id()], $request->all());
        session()->flash('success', __('Thank you for your feedback'));
        return redirect()->route('movies.index');
    } //end of rate


    public function edit(Movie $movie)
    {
        $categories = Category::select('id', 'title')->get();
        return view('movies.edit', compact('categories', 'movie'));
    } //end of view


    public function update(UpdateMovieRequest $request, Movie $movie)
    {
        $movies_data = $request->except(['image', 'categories_ids']);
        $movies_data['user_id'] = Auth::id();
        if ($request->image) {
            if ($movie->image != 'default.jpg') {
                $this->deleteImage($movie->image, 'movies/');
            }
            $movies_data['image'] = $this->uploadImage($request->image, 'images/movies');
        }
        $movie->update($movies_data);
        $movie->categories()->sync($request->categories_ids);
        session()->flash('success', __('Movie updated successfully'));
        return redirect()->route('movies.index');
    } //end of update


    public function destroy(Movie $movie)
    {
        if ($movie->image != 'default.jpg') {
            $this->deleteImage($movie->image, 'movies/');
        }
        $movie->categories()->detach();
        $movie->delete();
        session()->flash('success', __('Movie created successfully'));
        return redirect()->route('movies.index');
    } //end of destroy
}
