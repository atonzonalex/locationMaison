<?php

namespace App\Http\Controllers;

use App\Maison;
use App\APIError;
use Illuminate\Http\Request;

class MaisonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        $data = Maison::simplePaginate($req->has('limit') ? $req->limit : 15);
        //ceci te sera util pour ajouter l'url du serveur a tes images lorsque tu les retournes.
         foreach ($data as $not) {
            $not->image = url($not->image);
        } 
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $req)
    {
        //$this->validate($req->all(), [
           // 'nom_maison' => 'required',
           // 'id_type' => 'required',
           // 'prix' => 'required',
           // 'id_bailleur' => 'required',
            //'description' => 'required',
           // 'photo' => 'required',
       // ]);
        $data = [];
        $data = array_merge($data, $req->only([
            'nom_maison', 
            'id_type',
            'prix',
            'id_bailleur', 
            'description', 
            'photo',
            
        ]));
        $path1 = " ";
        //upload image
        if(isset($req->photo)){
            $photo = $req->file('photo'); 
            if($photo != null){
                $extension = $photo->getClientOriginalExtension();
                $relativeDestination = "uploads/MAISON";
                $destinationPath = public_path($relativeDestination);
                $safeName = "maison".time().'.'.$extension;
                $photo->move($destinationPath, $safeName);
                $path1 = "$relativeDestination/$safeName";
            }
        }
        $data['photo'] = $path1;
        $maison = new Maison();
        $maison ->nom_maison = $data['nom_maison'];
        $maison ->description = $data['description'];
        $maison ->photo = $data['photo'];
        $maison ->prix = $data['prix'];
        $maison ->id_bailleur = $data['id_bailleur'];
        $maison ->id_type = $data['id_type'];
        $maison ->save();
        return response()->json($maison);
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
     * @param  \App\Maisn  $maisn
     * @return \Illuminate\Http\Response
     */
    public function show(Maisn $maisn)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Maisn  $maisn
     * @return \Illuminate\Http\Response
     */
    public function edit(Maisn $maisn)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Maisn  $maisn
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req ,$id)
    {
        $maison = Maison::find($id);
        if($maison == null){
            $notfound = new APIError;
            $notfound->setStatus("404");
            $notfound->setCode("Maison_NOT_FOUND");
            $notfound->setMessage("Maison id not found in database.");
            return response()->json($notfound, 404);
        }

        $data = [];
        $data = array_merge($data, $req->only([
            'nom_maison', 
            'prix', 
            'id_bailleur',
            'id_type',
            'photo',
            'description',
        ]));
        $path1 = "";
        //upload image
        if(isset($req->photo)){
            $photo = $req->file('photo'); 
            if($photo != null){
                $extension = $photo->getClientOriginalExtension();
                $relativeDestination = "uploads/MAISON";
                $destinationPath = public_path($relativeDestination);
                $safeName = "maison".time().'.'.$extension;
                $photo->move($destinationPath, $safeName);
                $path1 = "$relativeDestination/$safeName";
            }
        }
        $data['photo'] = $path1;
        
         $maison ->nom_maison = $data['nom_maison'];
         $maison ->prix = $data['prix'];
         $maison ->id_type = $data['id_type'];
         $maison ->id_bailleur = $data['id_bailleur'];
         $maison ->photo = $data['photo'];
         $maison ->description = $data['description'];
        $maison->update();
        return response()->json($maison);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Maisn  $maisn
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $maison = Maison::find($id);
        if($maison == null){
            $notfound = new APIError;
            $notfound->setStatus("404");
            $notfound->setCode("MAISON_NOT_FOUND");
            $notfound->setMessage("Maison id not found in database.");
            return response()->json($notfound, 404);
        }
 
        $maison->delete();
         return response()->json(200);
    }

    // methode pour rechercher une categorie en base de donnee
    public function find($id){
       
        $maison = Maison::find($id);
        if($maison == null){
            $notfound = new APIError;
            $notfound->setStatus("404");
            $notfound->setCode("Maison_NOT_FOUND");
            $notfound->setMessage("Maison id not found in database.");
            return response()->json($notfound, 404);
        }
        return response()->json($maison);
      }
}
