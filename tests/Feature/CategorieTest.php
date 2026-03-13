<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategorieTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    // public function test_example(): void
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }


    public function test_create_categorie(){
        //envoyer une requste post
        $response=$this->postJson('/api/categorie',[
            'name'=>'enverenement'
        ]);
        $response->assertStatus(201);//virifier response
        // virifier si cate est existe ou non
        $this->assertDatabaseHas('categories',[
            'name'=>'enverenement'
        ]);
    }
}
