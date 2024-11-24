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

        $events = [
            (object) [
                'id' => 1,
                'name' => 'Thanksgiving Celebration',
                'image' => 'build/images/events/img-1.jpg',
                'startdate' => '2024-11-28',
            ],
            (object) [
                'id' => 2,
                'name' => 'New Year Party',
                'image' => 'build/images/events/img-3.jpg',
                'startdate' => '2024-12-31',
            ],
            (object) [
                'id' => 3,
                'name' => 'Charity Marathon',
                'image' => 'build/images/events/img-1.jpg',
                'startdate' => '2025-01-15',
            ],
            (object) [
                'id' => 4,
                'name' => 'Tech Conference 2025',
                'image' => 'build/images/events/img-5.jpg',
                'startdate' => '2025-02-20',
            ],
            (object) [
                'id' => 5,
                'name' => 'Music Festival',
                'image' => 'build/images/events/img-2.jpg',
                'startdate' => '2025-03-10',
            ],
        ];


        //$posts = Post::orderBy('updated_at', 'desc')->with(['comments', 'likes'])->paginate(10);
        $categgories = EventCategory::paginate(12);
        $domains = EventDomain::paginate(15);
        
        $tags = Tag::all();
         return view('welcome', compact('categgories','events','domains'));
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
