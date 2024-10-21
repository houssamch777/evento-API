<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Auth;
use Http;
use Illuminate\Http\Request;
use Redirect;

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
         $skills = Auth::user()->skills()->when($experience, function($query, $experience) {
             return $query->where('experience', $experience);
         })->orderBy('created_at', 'desc')->paginate(10);
     
         // Append the experience filter to pagination links
         $skills->appends(['experience' => $experience]);

         // Return the view with the filtered skills
         return view('skill.index', compact('skills'));
     }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('skill.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        

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
        $availability = [];
        if($request->input('offer_as_service')){
                $day = $request->input('day');
                $starttime = $request->input('start_time');
                $endtime = $request->input('end_time');

                
                // Loop through the arrays and combine them
                for ($i = 0; $i < count($day); $i++) {
                    $availability[$day[$i]] = $starttime[$i].'-'.$endtime[$i];
                }
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

            return redirect()->route('skills.index')->with('success', 'skill added successfully.');
        } else {

            return back()->withErrors(['error' => $response->json()['message']]);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Retrieve the skill by its ID
        $skill = Skill::findOrFail($id);
        $skills = Auth::user()->skills;
        $availability = $skill->availability;

        $hoursPerDay = [
            "Mo" => 0,
            "Tu" => 0,
            "We" => 0,
            "Th" => 0,
            "Fr" => 0,
            "Sa" => 0,
            "Su" => 0
        ];

        foreach ($availability as $day => $time_range) {
            [$start, $end] = explode('-', $time_range);
            $start_time = strtotime($start);
            $end_time = strtotime($end);
        
            // Calculate hours
            $hours = ($end_time - $start_time) / 3600;
            
            // Round the hours to one decimal place
            $hoursPerDay[$day] = round($hours, 1);
        }


        // Return the view and pass the skill and hoursPerDay variables
        return view('skill.show', compact('skill', 'skills', 'hoursPerDay'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $skill = Skill::findOrFail($id);
        $availability = $skill->availability;
        
        // إنشاء مصفوفات جديدة للتخزين
        $days = [];
        $startTimes = [];
        $endTimes = [];
        
        // Loop through the availability array
        foreach ($availability as $day => $time) {
            // تقسيم الوقت إلى بداية ونهاية
            list($startTime, $endTime) = explode('-', $time);
            
            // إضافة القيم إلى المصفوفات الجديدة
            $days[] = $day;
            $startTimes[] = $startTime;
            $endTimes[] = $endTime;
        }
        
        // إرسال البيانات إلى العرض
        return view('skill.edit', compact('skill', 'days', 'startTimes', 'endTimes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        
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
        $availability = [];
        if($request->input('offer_as_service')){
                $day = $request->input('day');
                $starttime = $request->input('start_time');
                $endtime = $request->input('end_time');

                
                // Loop through the arrays and combine them
                for ($i = 0; $i < count($day); $i++) {
                    $availability[$day[$i]] = $starttime[$i].'-'.$endtime[$i];
                }
        }
        $data=[
            // حقول التسجيل
            'name' => $request->input('name'),
            'experience' => $request->input('experience'),
            'offer_as_service' => $request->input('offer_as_service'),
            'portfolio_url' => $request->input('portfolio_url'),
            'cost' => $request->input('cost'),
            'cost_type' => $request->input('cost_type'),
            'availability' => $availability,
        ];
        $response = Http::withHeaders($headers)->put('https://evento.witslinks.com/api/skills/'.$id,$data );


        if ($response->successful()) {

            return redirect()->route('skills.index')->with('success', 'skill updated successfully.');
        } else {

            return back()->withErrors(['error' => $response->json()['message']]);
        }
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
           
           return redirect()->route('skills.index')->with('success', 'Skill link deleted successfully.');
        } else {
            return redirect()->back()->withErrors(['error' => 'You are not authorized to delete this Skill link.']);
        }
    }
}
