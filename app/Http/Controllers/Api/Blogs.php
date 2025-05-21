<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Blogs extends Controller
{
    public function index()
    {
        $data = Blog::with('user')->orderBy('created_at', 'DESC')->get();
        if ($data) {
            foreach ($data as $item) {
                $item->author = $item->user->name;
                unset($item->user);
            }
        }
        return response()->json(['data' => $data, 'error' => false, 'message' => 'All the blogs'], 200);
    }

    public function show($id)
    {
        $data = Blog::with('user')->find($id);

        if ($data) {
            $data->author = $data->user->name;
            unset($data->user);
            return response()->json(['data' => $data, 'error' => false, 'message' => 'Blog found'], 200);
        }
        return response()->json(['error' => false, 'message' => 'Blog not found'], 200);
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $user = auth()->user();

            $request->validate([
                'title' => 'required|string|max:255',
                'content' => 'required|string'
            ]);
            $blog = Blog::create([
                'title' => $request->title,
                'content' => $request->content,
                'author' => $user->id,
            ]);
            if (!$blog) {
                return response()->json(['error' => true, 'message' => 'Blog not created'], 500);
            }
            DB::commit();
            return response()->json(['data' => $blog, 'error' => false, 'message' => 'Blog created successfully'], 201);
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['error' => true, 'message' => $e->validator->errors()], 422);
        }
        catch (\Exception $e) {
            echo '<pre>'; print_r($e); exit;
            DB::rollBack();
            return response()->json(['error' => true, 'message' => 'An error occurred while creating the blog'], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try{
            DB::beginTransaction();
            $user = auth()->user();

            $request->validate([
                'title' => 'required|string|max:255',
                'content' => 'required|string'
            ]);
            $blog = Blog::find($id);
            if (!$blog) {
                return response()->json(['error' => true, 'message' => 'Blog not found'], 200);
            }
            $blog->update([
                'title' => $request->title,
                'content' => $request->content,
                'author' => $user->id,
            ]);
            DB::commit();
            return response()->json(['data' => $blog, 'error' => false, 'message' => 'Blog updated successfully'], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['error' => true, 'message' => $e->validator->errors()], 422);
        }
        catch (\Exception $e) {
            echo '<pre>'; print_r($e); exit;
            DB::rollBack();
            return response()->json(['error' => true, 'message' => 'An error occurred while creating the blog'], 500);
        }
    }

    public function destroy($id)
    {
        $blog = Blog::find($id);
        if (!$blog) {
            return response()->json(['error' => true, 'message' => 'Blog not found'], 200);
        }
        $blog->delete();
        return response()->json(['error' => false, 'message' => 'Blog deleted successfully'], 200);
    }
}
