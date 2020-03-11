<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['author', 'body', 'photo'];

    public function photoFilename() {
        return "photos/{$this->photoHash()}.jpg";
    }

    public function photoHash() {
        return md5($this->body);
    }
}
