<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDocument extends Model
{
    use \App\Traits\UuidTrait;

    public $incrementing = false;
    
    public function User()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function Document()
    {
        return $this->belongsTo('App\Models\Document');
    }
}
