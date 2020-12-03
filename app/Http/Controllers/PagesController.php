<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

class PagesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('pages.index');
    }

    public function service()
    {
        $data = [
            'title' => 'Services',
            'services' => ['Backend Services', 'Web Designing', 'Mobile Development', 'Dev-Ops'],
        ];
        return view('pages.service')->with($data);
    }

    public function frontend()
    {
        $category = Category::firstWhere('category', 'Frontend Development');
        $posts = $this->paginate($category->posts);
        return view('pages.frontend', compact('posts'));
    }

    public function paginate($items, $perPage = 10, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

    public function backend()
    {
        $category = Category::firstWhere('category', 'Backend Development');
        $posts = $this->paginate($category->posts);
        return view('pages.backend', compact('posts'));
    }
    public function devops()
    {
        $category = Category::firstWhere('category', 'Dev-Ops');
        $posts = $this->paginate($category->posts);
        return view('pages.devops', compact('posts'));
    }
}
