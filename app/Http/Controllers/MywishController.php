<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mywish;
use Validator;
use App\Http\Requests;
use App\Http\Resources\Mywish as MywishResource;

class MywishController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wishs = Mywish::latest()->orderBy('created_at', 'desc')->paginate(3);
        return MywishResource::collection($wishs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'wish' => 'required'
        ]);
        
        if($validator->fails()){
            $response = array('response'=> $validator->messages(), 'success'=>false);
            return $response;
        }
        else{
            //create Item
            $wish= new Mywish;
            $wish->name = $request->input('name');
            $wish->wish = $request->input('wish');
            $wish->save();
            return response()->json($wish);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $wish = Mywish::find($id);
        return response()->json($wish);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'wish' => 'required'
        ]);
        
        if($validator->fails()){
            $response = array('response'=> $validator->messages(), 'success'=>false);
            return $response;
        }
        else{
            //create Item
            $wish= Mywish::find($id);
            $wish->name = $request->input('name');
            $wish->wish = $request->input('wish');
            $wish->save();
            return response()->json($wish);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        {
            $wish= Mywish::find($id);
            $wish->delete();
   
            $response = array('response'=> 'Wish Deleted', 'success'=>true);
            return $response;
       }
    }
}
