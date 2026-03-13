<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Categorie;
use App\Models\Livre;

class LivreTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    // public function test_example(): void
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }

    public function test_filter_livre(){
        $categorie=Categorie::create([
            'name'=>'science',
        ]);
        $livre1=Livre::create([
            'titre'=>'abc',
            'auteur'=>'mohammed elgotby',
            'quantite'=>20,
            'nbr_degrade'=>7,
            'categorie_id'=>$categorie->id,
        ]);
        $livre2=Livre::create([
            'titre'=>'efgh',
            'auteur'=>'elgotby admin',
            'quantite'=>4,
            'nbr_degrade'=>0,
            'categorie_id'=>$categorie->id,
        ]);//apeler api
        $response=$this->getJson('/api/livre/search?titre=efgh');
        $response->assertStatus(200);

        $response->assertJsonFragment([
            'titre'=>'efgh'
        ]);
    }
}
