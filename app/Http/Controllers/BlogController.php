<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Blog;


class BlogController extends Controller
{
    public function index()
    {
        // Fetch all blog posts
        $data = Blog::with('user')->orderBy('id', 'DESC')->get();
        if ($data) {
            foreach ($data as $item) {
                $item->author = $item->user->name;
                unset($item->user);
            }
        }
        return Inertia::render('Blog/Index', ['blogs' => $data]);
    }

    public function create()
    {
        return Inertia::render('Blog/Create');
    }

    public function edit($id)
    {
        return view('blogs.edit', ['id' => $id]);
    }
    public function show($id)
    {
        return view('blogs.show', ['id' => $id]);
    }
    public function destroy($id)
    {
        // Logic to delete the blog post
        return redirect()->route('blog.index')->with('success', 'Blog deleted successfully');
    }
    public function update(Request $request, $id)
    {
        // Logic to update the blog post
        return redirect()->route('blog.index')->with('success', 'Blog updated successfully');
    }
    public function store(Request $request)
    {
        echo '<pre>'; print_r($request->all()); exit;
        // Logic to store the blog post
        return redirect()->route('blog.index')->with('success', 'Blog created successfully');
    }
}
