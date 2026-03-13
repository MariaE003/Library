<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Resources\CategoryResource;

class CategorieController extends Controller
{
    //
    public function store(Request $request){
        $request->validate([
            'name'=>'required',
        ]);
        $categorie=Category::create([
            'name'=>$request->name,
        ]);

        return response()->json([
            'message'=>'categorie ajouter avec succes',
            'categorie'=>$categorie,
        ],201);

    }
    public function index(){
        $categories=Category::all();
        return response()->json([
            'message'=>'les categories disponible sont :',
            'categories'=>$categories,
        ]);
    }
    
}
