<?php

namespace App\Http\Controllers;
use App\Http\Models\Product;
use App\Models\Product as ModelsProduct;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'id' => 'products',
            'menu' => 'Gallery',
            'galleries' => ModelsProduct::where('image', '!=', '')
                                ->whereNotNull('image')
                                ->orderBy('created_at', 'desc')
                                ->paginate(30)
        ];
        return view('products.gallery')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}