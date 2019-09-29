<?php

namespace App\Presenters;

trait UserPresenter
{
    // ACCESORS
    public function getAvatarAttribute()
    {
        $email = $this->email;
        $size = 32;

        return "https://www.gravatar.com/avatar/" . md5(strtolower(trim($email))) . "&s=" . $size;
    }

    public function getUrlAttribute()
    {
        return "#";
    }
}
