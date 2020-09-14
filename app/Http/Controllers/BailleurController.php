<?php

namespace App\Http\Controllers;

use App\Bailleur;
use App\APIError;
use Illuminate\Http\Request;

class BailleurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        $data = Bailleur::simplePaginate($req->has('limit') ? $req->limit : 15);
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $req)
    {
        $data = $req->all();
        $data = $req->validate([
            'nom_bailleur' => 'required', 
            'telephone' => 'required',
        ]);
        $bailleur = new Bailleur();
        $bailleur ->nom_bailleur = $data['nom_bailleur'];
        $bailleur ->telephone = $data['telephone'];
        $bailleur ->save();
        return response()->json($bailleur);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Bailleur  $bailleur
     * @return \Illuminate\Http\Response
     */
    public function show(Bailleur $bailleur)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Bailleur  $bailleur
     * @return \Illuminate\Http\Response
     */
    public function edit(Bailleur $bailleur)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Bailleur  $bailleur
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id)
    {
        $bailleur = Bailleur::find($id);
        if($bailleur == null){
            $notfound = new APIError;
            $notfound->setStatus("404");
            $notfound->setCode("BAILLEUR_NOT_FOUND");
            $notfound->setMessage("Bailleur id not found in database.");
            return response()->json($notfound, 404);
        }

        $data = $req->all();
        $data = $req->validate([
            'nom_bailleur' => 'required', 
            'telephone' => 'required',
        ]);
        
         $bailleur ->nom_bailleur = $data['nom_bailleur'];
       
         $bailleur ->telephone = $data['telephone'];
        $bailleur->update();
        return response()->json($bailleur);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Bailleur  $bailleur
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $bailleur = Bailleur::find($id);
       if($bailleur == null){
           $notfound = new APIError;
           $notfound->setStatus("404");
           $notfound->setCode("BAILLEUR_NOT_FOUND");
           $notfound->setMessage("Baillleur id not found in database.");
           return response()->json($notfound, 404);
       }

       $bailleur->delete();
        return response()->json(200);
    }

    // methode pour rechercher une categorie en base de donnee
    public function find($id){
       
        $bailleur = Bailleur::find($id);
        if($bailleur == null){
            $notfound = new APIError;
            $notfound->setStatus("404");
            $notfound->setCode("BAILLEUR_NOT_FOUND");
            $notfound->setMessage("Bailleur id not found in database.");
            return response()->json($notfound, 404);
        }
        return response()->json($bailleur);
      }
}
