<?php

namespace App\Http\Controllers;

use App\Models\Production;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class ProductionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Production::search(trim(request('search')) ?? null)
        ->query(fn ($query) => $query->join('users', 'productions.user_id', 'users.id')
                ->select(['productions.id', 'productions.title', 'productions.slug', 'productions.body', 'productions.image', 'productions.price', 'users.name as author', 'productions.created_at'])
                ->when(request('author') ?? null, fn ($query) => $query->where('users.name', request('author')))
                ->orderBy('productions.created_at', 'DESC'))
        ->paginate(6)
        ->withQueryString()
        ->through(fn ($post) => [
            'title' => $post->title,
            'slug' => $post->slug,
            'body' => $post->body,
            'price' => $post->price,
            'image' => $post->image,
            'author' => $post->author,
            'created_at' => $post->created_at->diffForHumans(),
        ]);

        return Inertia::render('Dashboard/Products/Index', [
            'posts' => $data,
            'authors' => Production::select('user_id')->distinct()->get()->map(fn ($post) => $post->author->name)->unique()->values(),
            'filters' => request()->only(['search', 'category', 'author']),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Production  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Production $post)
    {
        return Inertia::render('Dashboard/Products/Detail', [
            'post' => [
                'title' => $post->title,
                'image' => $post->image,
                'body' => $post->body,
                'author' => $post->author->name,
                'slug' => $post->slug,
                'price' => $post->price,
                'created_at' => $post->created_at->diffForHumans(),
            ],
        ]);
    }
}
