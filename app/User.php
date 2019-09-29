<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    use Presenters\UserPresenter;

    protected $appends = ['avatar'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function questions()
    {
        return $this->hasMany('App\Question');
    }

    public function answers()
    {
        return $this->hasMany('App\Answer');
    }

    public function favorites()
    {
        return $this->belongsToMany('App\Question', 'favorites')->withTimestamps();
        /*
        SQL: select `questions`.*, `question_user`.`user_id` as `pivot_user_id`, `question_user`.`question_id` as `pivot_question_id` from `questions` inner join `question_user` on `questions`.`id` = `question_user`.`question_id` where `question_user`.`user_id` = 1
        */
    }
    // many to many polimorphic
    public function voteQuestions()
    {
        return $this->morphedByMany('App\Question', 'votable');
    }

    public function voteAnswers()
    {
        return $this->morphedByMany('App\Answer', 'votable');
    }
}
