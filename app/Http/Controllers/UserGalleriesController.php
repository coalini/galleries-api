<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gallery;
use App\User;

class UserGalleriesController extends Controller
{
    public function index(Request $request, $id) {
        $term = $request->input('term');
        
        return Gallery::filter($term, $id);
    }
}
