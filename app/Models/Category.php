<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Livre;

class Category extends Model
{
    //
    protected $fillable=[
        'name',
    ];

    public function livre(){
        return $this->hasMany(Livre::class);
    }

}
