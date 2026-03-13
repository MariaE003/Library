<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\LivreController;



// categorie
Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login'])->name('login');

Route::middleware('auth:sanctum')->group(function (){
    
    // Route::post('/categorie',[CategorieController::class,'save']);//done
    // Route::post('/categorie/show',[CategorieController::class,'show']);
    
    // Route::delete('/categorie/{id}/delete',[CategorieController::class,'delete']);
    // Route::get('/categories/{category}',[CategorieController::class,'show']);

    Route::apiResource('categories',CategorieController::class);
    
    // livre
    Route::post('/livre',[LivreController::class,'save']);//done
    Route::get('/livre/show',[LivreController::class,'show']);
    // get
    Route::delete('/livre/{id}/delete',[LivreController::class,'delete']);
    
    Route::put('/livre/{id}',[LivreController::class,'update']);
    // search
    Route::get('/livre/search',[LivreController::class,'search']);
    
    Route::get('/livre/LivresParCategorie',[LivreController::class,'LivresParCategorie']);
    
    Route::get('/livre/showOne/{id}',[LivreController::class,'showOne']);
    
    Route::get('/livre/populaire',[LivreController::class,'LivrePlusConsulter']);
    
    Route::get('/livre/livreDegrade',[LivreController::class,'livreDegrade']);
    
    Route::get('/livre/statistique',[LivreController::class,'statistique']);
});






Route::middleware('auth:sanctum')->group(function(){
    Route::post('/logout',[AuthController::class,'logout']);
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
