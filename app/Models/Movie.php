<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;
use Illuminate\Database\Eloquent\Builder;

class Movie extends Model
{
    use HasFactory, Translatable;
    protected $translatable = ['title','country','director','cast','description'];
    
}
