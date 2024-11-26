<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventCategory;
use App\Models\EventDomain;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        //$events = Event::orderBy('created_at', 'desc')->paginate(10);

        $topEvents = Event::withCount('reviews') // 'reviews' is the relationship method
            ->orderBy('reviews_count', 'desc')
            ->take(5)->with(['categories', 'visualIdentity', 'domains']) // Limit to the top 5
            ->get();
        //$posts = Post::orderBy('updated_at', 'desc')->with(['comments', 'likes'])->paginate(10);
        $categgories = EventCategory::paginate(12);
        $domains = EventDomain::paginate(15);
        
        $tags = Tag::all();
         return view('welcome', compact('categgories','topEvents','domains'));
    }
    public function loadMore($page)
    {
        // Fetch the next set of posts based on the page query parameter
        $postsPerPage = 10; // Define the number of posts per page

        $posts = Post::with(['likes', 'comments'])
            ->skip(($page - 1) * $postsPerPage)
            ->take($postsPerPage)
            ->get();

        // Return a JSON response with the posts
        return response()->json($posts);
    }
    public function renderPost(Request $request)
    {
        // Get the post data
        $post = $request->post;

        // Render the Blade component as HTML and return it
        return response()->json(view('components.post', ['post' => $post])->render());
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
