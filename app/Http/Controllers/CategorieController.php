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
    public function destroy($id){
        $categorie=Category::find($id)->delete();
        return response()->json([
            'message'=>'la categorie supprimer avce succec',
        ]);
    }

    public function update(Request $request,$id){
        // $categorie=Category::where('id',$id)->update([
        //     'name'=>$request->name,
        // ]);
        $categorie=Category::find($id);

        $categorie->name = $request->name;
        $categorie->save();
        return response()->json([
            'message'=>'categorie modifier avec succes',
            'categorie'=>$categorie,
        ]);
    }
    public function show(Category $category) {
        return response()->json([
            'categorie'=> $category,
        ]);
    }
}
