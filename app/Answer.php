<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use Presenters\AnswerPresenter;
    use Traits\VotableTrait;

    protected $fillable = ['body', 'user_id'];
    protected $appends = ['created_date', 'excerpt', 'is_best', 'is_voted', 'status']; // accesors
    protected $with = ['user', 'question', 'users'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function question()
    {
        return $this->belongsTo('App\Question');
    }

    public static function boot()
    {
        parent::boot();

        static::created(function ($answer) {
            //echo 'answer created\n';
            $answer->question->increment('answers_count');
        });

        static::deleted(function ($answer) {
            $answer->question->decrement('answers_count');
            /*if($answer->question->best_answer_id === $answer->id) {
                $answer->question->best_answer_id = NULL;
                $answer->question->save();
            }*/
            // ustawiony klucz obcy w tabeli alter do 'questions' na 'SET NULL' podczas usuwania
        });
    }

    public function users()
    {
        return $this->morphToMany('App\User', 'votable');
    }
}
