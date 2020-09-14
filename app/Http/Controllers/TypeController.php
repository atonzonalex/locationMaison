<?php

namespace App\Http\Controllers;

use App\Type;
use App\APIError;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        $data = Type::simplePaginate($req->has('limit') ? $req->limit : 15);
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
            'nom_type' => 'required', 
            'description' => 'required',
        ]);
        $type = new Type();
        $type ->nom_type = $data['nom_type'];
        $type ->description = $data['description'];
        $type ->save();
        return response()->json($type);
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
     * @param  \App\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $type = Type::find($id);
        if($type == null){
            $notfound = new APIError;
            $notfound->setStatus("404");
            $notfound->setCode("TYPE_NOT_FOUND");
            $notfound->setMessage("Type id not found in database.");
            return response()->json($notfound, 404);
        }
        return response()->json($type);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function edit(Type $type)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id)
    {
        $type = Type::find($id);
        if($type == null){
            $notfound = new APIError;
            $notfound->setStatus("404");
            $notfound->setCode("TYPE_NOT_FOUND");
            $notfound->setMessage("Type id not found in database.");
            return response()->json($notfound, 404);
        }

        $data = $req->all();
        $data = $req->validate([
            'nom_type' => 'required', 
            'description' => 'required',
        ]);
        
         $type ->nom_type = $data['nom_type'];
       
         $type ->description = $data['description'];
        $type->update();
        return response()->json($type);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $type = Type::find($id);
        if($type == null){
            $notfound = new APIError;
            $notfound->setStatus("404");
            $notfound->setCode("TYPE_NOT_FOUND");
            $notfound->setMessage("Type id not found in database.");
            return response()->json($notfound, 404);
        }
 
        $type->delete();
         return response()->json(200);
    }

}
