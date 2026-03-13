<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Livre;
use App\Models\Category;
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

    public function update(Request $request,$id){
        $Livre=Livre::find($id);

        $Livre->titre=$request->titre;
        $Livre->auteur=$request->auteur;
        $Livre->quantite=$request->quantite;
        $Livre->nbr_degrade=$request->nbr_degrade;
        $Livre->categorie_id=$request->categorie_id;
        $Livre->save();

        return response()->json([
            'message'=>'Livre modifier avec succes',
            'Livre'=>$Livre,
        ]);
    }

    public function search(Request $request){
        if($request->titre){
            $query=Livre::where('titre','like','%'.$request->titre.'%');
        }

        if($request->categorie_id){
            $query=Livre::where('categorie_id',$request->categorie_id);
        }
        $Livre=$query->get();
        return response()->json([
            'message'=>'Livres :',
            'Livre'=>$Livre,
        ]);
    }
    public function LivresParCategorie(Request $request){
        $livres=Livre::where('categorie_id',$request->categorie_id)->get();
        return response()->json([
            'message'=>'Livres :',
            'Livre'=>$livres,
        ]);
    }

    public function LivrePlusConsulter(){
        $livres=Livre::orderBy('consultations','desc')->limit(2)->get();
        return response()->json([
            'message'=>'les livres les plus consulter sont :',
            'livre'=>$livres
        ]);
    }

    public function livreDegrade(){
        $livre=Livre::where('nbr_degrade','>',0)->get();
        return response()->json([
            'message'=>'les livres qui ont degrader sont :',
            'livre'=>$livre
        ]);
    }

    public function statistique(){
        $nbr_livre=Livre::count();
        $nbr_cat=Category::count();
        $livre_Degrader=Livre::sum('nbr_degrade');
        return response()->json([
            'message'=>'les livres qui ont degrader sont :',
            'nbr_livres'=>$nbr_livre,
            'nbr_cat'=>$nbr_cat,
            'livre_Degrader'=>$livre_Degrader,
        ]);
    }


}

