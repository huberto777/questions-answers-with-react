<?php

namespace App\Presenters;

trait AnswerPresenter
{
    // ACCESORS
    public function getCreatedDateAttribute()
    {
        return $this->created_at ? $this->created_at->diffForHumans() : null;
    }

    // public function getBodyHtmlAttribute()
    // {
    //     return clean(\Parsedown::instance()->text($this->body));
    // }

    public function getStatusAttribute()
    {
        return $this->isBest ? 'vote-accepted' : ''; // isBest jest atrybutem a nie funkcją
    }

    public function getIsBestAttribute()
    {
        return $this->id === $this->question->best_answer_id;
    }

    public function getExcerptAttribute()
    {
        return strip_tags($this->body);
    }
}
