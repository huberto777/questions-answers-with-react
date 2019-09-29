<?php

namespace App\Traits;

trait VotableTrait
{
    public function isVoted()
    {
        return $this->users()->where('user_id', \Auth::user()->id ?? false)->exists();
    }

    public function getIsVotedAttribute()
    {
        return $this->isVoted();
    }
}
