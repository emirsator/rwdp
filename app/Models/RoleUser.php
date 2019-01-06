<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    use \App\Traits\UuidTrait;

    protected $table = 'role_user';
    public $incrementing = false;

    public function User()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function Role()
    {
        return $this->belongsTo('App\Models\Role');
    }
}
