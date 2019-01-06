<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use \App\Traits\UuidTrait;

    public $incrementing = false;
    
}
