<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\ProductoResource;
use Illuminate\Http\Request;
use App\Models\Producto;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ProductoResource::collection(Producto::all());
    }



    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        return new ProductoResource(Producto::find($id));
    }


    
    /**
     * Store a newly created resource in storage.
     *
     * @param  Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required',
            'cantidad' => 'required',
        ]);

        return new ProductoResource(Producto::create($validated));
    }
    


    /**
     * Update the specified resource in storage.
     *
     * @param  Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $validated = $request->validate([
            'nombre' => 'required',
            'cantidad' => 'required',
        ]);

        try {
            $Producto = Producto::findOrFail($id);

        } catch (ModelNotFoundException $exception) {

            return response()->json([
                'status' => false,
                'error' => 'Resource not found'
            ], 404);
            
        }

        if($Producto->update($validated))
            return new ProductoResource($Producto);
        
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        
        try {

            $Producto = Producto::findOrFail($id);

        } catch (ModelNotFoundException $exception) {

            return response()->json([
                'status' => false,
                'error' => 'Resource not found'
            ], 404);

        }

        if($Producto->delete())
            return response()->json([
                'status' => true,
                'message' => 'Resource deleted'
            ], 200);

    }
}
