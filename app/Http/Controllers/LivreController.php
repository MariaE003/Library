<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Livre;
use App\Models\Categorie;
class LivreController extends Controller
{
    public function save(Request $request){
        $request->validate([
            'titre'=>'required',
            'auteur'=>'required',
            'quantite'=>'required',
            'nbr_degrade'=>'required',
            'categorie_id'=>'required',
        ]);
        $livre=Livre::create([
            'titre'=>$request->titre,
            'auteur'=>$request->auteur,
            'quantite'=>$request->quantite,
            'nbr_degrade'=>$request->nbr_degrade,
            'categorie_id'=>$request->categorie_id,
        ]);

        return response()->json([
            'message'=>'livre ajouter avec succes',
            'categorie'=>$livre,
        ]);

    }
    
    public function show(){
        $Livres=Livre::all();
        return response()->json([
            'message'=>'les Livres disponible sont :',
            'Livres'=>$Livres,
        ]);
    }
    public function showOne($id){
        $livre=Livre::findOrFail($id);
        // if (!$livre) {
        //     return response()->json([
        //     'message'=>'votre Livres est introuvable',
        // ]);
        // }
        $livre->consultations++;
        $livre->save();
        return response()->json([
            'message'=>'les Livres disponible sont :',
            'Livres'=>$livre,
        ]);
    }
    public function delete(Request $request){
        $Livre=Livre::where('id',$request->id)->delete();
        return response()->json([
            'message'=>'la Livre supprimer avec succes',
        ]);
    }

    
}

