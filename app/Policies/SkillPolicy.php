<?php

namespace App\Policies;

use App\Models\Skill;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SkillPolicy
{


    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Skill $skill): Response
    {
        //
        
        return $user->id === $skill->user_id
        ? Response::allow()
        :Response::deny('you do not own this skill');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Skill $skill): Response
    {
        //
        return $user->id === $skill->user_id
        ? Response::allow()
        :Response::deny('you do not own this skill');
    }


}
