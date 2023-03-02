<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary as xd;


class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $images = Image::all();
        return response()->json(['Images'=>$images]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
        $file = request()->file('imagenP');
        $obj =xd::upload($file->getRealPath(), ['folder' => 'imagenes']);
              $id_imagen = $obj->getPublicId();
              $url_imagen = $obj->getSecurePath();

      

        Image::create([
            'nombre'=>$request->nombre,
            'tipo'=>$request->tipo,
            'imagen'=>$id_imagen,
            'url'=>$url_imagen,
            'url_pelicula'=>$request->url_pelicula,
            

        ]);

        return response()->json(['Messages'=>'Se creo con exito']);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $image = Image::find($id);
        return response()->json(['Images'=>$image]);

        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
                
        $image = Image::find($id);
        $url = $image->url;
        $id_imagen = $image->imagen;

        if ($request->hasFile('imagenP')) {
            xd::destroy($id_imagen);
            
            $file = request()->file('imagenP');
            $obj =xd::upload($file->getRealPath(), ['folder' => 'imagenes']);
            $url = $obj->getSecurePath();
            $id_imagen = $obj->getPublicId();
        }

        $image->update([
            'nombre'=>$request->nombre,
            'tipo'=>$request->tipo,
            'imagen'=>$id_imagen,
            'url'=>$url,
            'url_pelicula'=>$request->url_pelicula,
            
        ]); 

        return response()->json(['message'=>'Actualizado'],200);
    }


        

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        $image = Image::find($id);
        $public_id = $image->imagen;
        xd::destroy($public_id);
        Image::destroy($id);

        return response()->json([
            'message' => "Eliminado"
        ],200);

    }
}
