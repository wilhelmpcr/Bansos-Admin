<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function index($id)
    {
        return "Index Media untuk warga ID: ".$id;
    }

    public function create($id)
    {
        return "Upload media warga ID: ".$id;
    }

    public function store(Request $request, $id)
    {
        return "Store media";
    }

    public function destroy($id, $media_id)
    {
        return "Delete media";
    }
}
