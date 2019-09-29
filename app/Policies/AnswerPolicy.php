<?php

namespace App\Policies;

use App\{User, Answer};
use Illuminate\Auth\Access\HandlesAuthorization;

class AnswerPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function update(User $user, Answer $answer)
    {
        return $user->id === $answer->user_id;
    }

    public function delete(User $user, Answer $answer)
    {
        return $user->id === $answer->user_id;
    }

    public function accept(User $user, Answer $answer)
    {
        return $user->id === $answer->question->user_id;
    }

}
