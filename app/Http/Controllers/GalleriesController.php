<?php

namespace App\Http\Controllers;

use App\Gallery;
use App\Image;
use Illuminate\Http\Request;
use App\Http\Requests\GalleryRequest;

class GalleriesController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api')->except(['index', 'show']);
    }

    public function index(Request $request)
    {
        $term = $request->input('term');

        return Gallery::filter($term);
    }

    public function store(GalleryRequest $request)
    {
        $gallery = new Gallery();
        $gallery->title = $request->title;
        $gallery->description = $request->description;
        $gallery->user_id = auth()->user()->id;
        $gallery->save();

        $imgs = [];
        foreach($request->images as $img) {
            $imgs[] = new Image($img);
        }
        $gallery->images()->saveMany($imgs);
        
        return $this->show($gallery->id);
    }

    public function show($id)
    {
        $gallery = Gallery::with(['images', 'user', 'comments', 'comments.user'])->find($id);
        
        return $gallery;
    }

    public function update(GalleryRequest $request, $id)
    {
        $gallery = Gallery::find($id);
        $gallery->title = $request->title;
        $gallery->description = $request->description;
        $gallery->user_id = auth()->user()->id;
        $gallery->save();        
        
        $gallery->images()->delete();
        $imgs = [];
        foreach(request('images') as $img) {
            $imgs[] = new Image($img);
        }
        $gallery->images()->saveMany($imgs);

        return $this->show($gallery->id);
    }

    public function destroy($id)
    {
        $gallery = Gallery::find($id);
        $gallery->delete();

        return response()->json([
            'message' => 'Deleted'
        ]);
    }
}
