<?php

namespace App\Http\Controllers\Api;

use App\Models\Skill;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Gate;

class SkillController extends Controller implements HasMiddleware
{

    public static function middleware(){
        return [
            new Middleware('auth:sanctum',except:['index','show'])
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return Skill::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        
        $fields=$request->validate(
            [
                'name'=>'required|max:255',
                'experience'=>'required',
            ]
        );
        
        $skill=$request->user()->skills()->create($fields);
        return $skill; 
    }

    /**
     * Display the specified resource.
     */
    public function show(Skill $skill)
    {
        //
        return $skill;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Skill $skill)
    {
        //

        Gate::authorize('update',$skill);
        $fields=$request->validate(
            [
                'name'=>'required|max:255',
                'experience'=>'required',
            ]
        );
        $skill->update($fields);
        return $skill;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Skill $skill)
    {
        //
        Gate::authorize('delete',$skill);
        $skill->delete();
        return ['message'=>'skill delleted'];
    }
}
