<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Developer extends Model
{
    public mixed $name;
    protected $fillable = ['name'];
}
