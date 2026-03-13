<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Categorie;
class Livre extends Model
{
    protected $fillable=[
        'titre','auteur','quantite','nbr_degrade','categorie_id'
    ];


    public function categorie(){
        return $this->belongsTo(Categorie::class);
    }
}
