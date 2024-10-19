<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Auth;
use Http;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    public function index(Request $request)
    {
        // Get the experience filter from the query string
        $experience = $request->query('experience');
    
        // Fetch the skills, applying the experience filter if it exists
        $skills = Skill::when($experience, function($query, $experience) {
            return $query->where('experience', $experience);
        })->paginate(10);
    
        // Return the view with the filtered skills
        return view('user.skill', compact('skills'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('user.add-skill');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        
       // dd($request->input());
        $fields = $request->validate([
            'name' => 'required|max:255',
            'experience' => 'required|in:Beginner,Intermediate,Expert',
            'offer_as_service' => 'boolean',
            'portfolio_url' => 'nullable|url',
            'cost' => 'nullable|numeric',
            'cost_type' => 'nullable|in:per_hour,per_task',
            
        ]);

         // Get the authenticated user and their token
        $user = Auth::user();
        $token = $user->createToken('skill-token')->plainTextToken;
        $headers = [
            'Accept' => 'application/json', 
            'Authorization' => 'Bearer ' . $token,
    
        ];
        $day = $request->input('day');
        $starttime = $request->input('start_time');
        $endtime = $request->input('end_time');

        $availability = [];
        // Loop through the arrays and combine them
        for ($i = 0; $i < count($day); $i++) {
            $availability[$day[$i]] = $starttime[$i].'-'.$endtime[$i];
        }
        $response = Http::withHeaders($headers)->post('https://evento.witslinks.com/api/skills', [
            // حقول التسجيل
            'name' => $request->input('name'),
            'experience' => $request->input('experience'),
            'offer_as_service' => $request->input('offer_as_service'),
            'portfolio_url' => $request->input('portfolio_url'),
            'cost' => $request->input('cost'),
            'cost_type' => $request->input('cost_type'),
            'availability' => $availability,
        ]);
        
        if ($response->successful()) {
           // dd('skill added successfully.');
            return back()->with('success', 'skill added successfully.');
        } else {
           // dd($response->json()['message']);
            return back()->withErrors(['error' => $response->json()['message']]);
        }

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

        $user = Auth::user();
    $token = $user->createToken('Skill-token')->plainTextToken;
        $headers = [
            'Accept' => 'application/json', 
            'Authorization' => 'Bearer ' . $token,
        ];
        $url='https://evento.witslinks.com/api/skills/'.$id;
        $response = Http::withHeaders($headers)->delete($url);
        
        if ($response->successful()) {
           
           return redirect()->back()->with('success', 'Skill link deleted successfully.');
        } else {
            return redirect()->back()->withErrors(['error' => 'You are not authorized to delete this Skill link.']);
        }
    }
}
