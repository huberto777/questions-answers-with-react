<?php

namespace App\Presenters;

use Illuminate\Support\Str;

trait QuestionPresenter
{
    // MUTATOR
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function excerpt($length)
    {
        return Str::limit(strip_tags($this->body), $length);
    }

    // ACCESOR
    public function getExcerptAttribute()
    {
        return $this->excerpt(250);
    }

    // ACCESOR
    public function getFavoritesCountAttribute()
    {
        return $this->favorites->count();
    }

    public function getUrlAttribute()
    {
        return route('questions.show', $this->slug);
    }

    public function getCreatedDateAttribute()
    {
        return $this->created_at ? $this->created_at->diffForHumans() : null;
    }

    public function getStatusAttribute()
    {
        if($this->answers_count > 0)
        {
            if($this->best_answer_id)
            {
                return "answered-accepted";
            }
            return "answered";
        }

        return "ananswered";
    }



// METHODS
    public function isFavorited()
    {
        return $this->favorites()->where('user_id', \Auth::user()->id ?? false)->count() > 0;
    }

    public function getIsFavoritedAttribute()
    {
        return $this->isFavorited();
    }

}
