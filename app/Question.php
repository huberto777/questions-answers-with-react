<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use Presenters\QuestionPresenter;
    use Traits\VotableTrait;

    protected $fillable = ['title', 'body'];
    protected $appends = ['created_date', 'is_favorited', 'favorites_count', 'is_voted']; // dołączenie atrybutów z trait
    // atrybuty np. created_date - zapis snake_case
    // accesors zapis camelCase np. getBodyHtmlAttribute

    // funkcja zdefiniowana w Model.php
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function answers()
    {
        return $this->hasMany('App\Answer')->orderBy('votes_count', 'desc');
    }

    public function acceptBestAnswer(Answer $answer)
    {
        $this->best_answer_id = $answer->id;
        $this->save();
    }

    public function favorites()
    {
        return $this->belongsToMany('App\User', 'favorites')->withTimestamps();
    }

    public function users()
    {
        return $this->morphToMany('App\User', 'votable');
    }
}
