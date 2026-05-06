<?php

namespace App\Http\Controllers;


use App\Models\polygonModel;
use Illuminate\Http\Request;

class PolygonController extends Controller
{
    protected $polygon;
    public function __construct()
    {
        $this->polygon = new polygonModel();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        //validasi input
        $request->validate([
            'geometry_polygon' => 'required',
            'name' => 'required',
            'description' => 'required'
        ], [
            'geometry_polygon.required' => 'Field geometry poligon harus diisi',
            'name.required' => 'Field name harus diisi',
            'description.required' => 'Field description harus diisi',
            'name.string' => 'Field name harus berupa string',
            'description.string' => 'Field description harus berupa string',
            'image.image' => 'File harus berupa file gambar.',
            'image.mimes' => 'File gambar harus berformat jpeg, png, atau jpg.',
            'image.max' => 'Maksimal ukuran file gambar 2MB.'
        ]);

        // Create directory for images if it doesn't exist
        if (!is_dir('storage/images')) {
            mkdir('./storage/images', 0777);
        }

        //Get file image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name_image = time() . "_polygon." . strtolower($image->getClientOriginalExtension());
            $image->move('storage/images', $name_image);
        } else {
            $name_image = null;
        }

        $data = [
            'geom' => $request->geometry_polygon,
            'name' => $request->name,
            'description' => $request->description,
            'image' => $name_image
        ];


        if (!$this->polygon->create($data)) {
            return redirect()->route('peta')->with('error', 'Failed to save polygon data. Please try again.');
        }


        return redirect()->route('peta')->with('success', 'Polygon saved successfully.');
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
        //hapus gambar
        $image = $this->polygon->find($id)->image;

        // Cek jika gambar ada, lalu hapus
        if (!$this->polygon->destroy($id)) {
            return redirect()->route('peta')->with('error', 'Failed to delete polygon data. Please try again.');
        }

        //hapus file gambar jika ada
        if ($image != null) {;
            if (file_exists('.storage/images/' . $image)) {
                unlink('.storage/images/' . $image);
            }
        }

        // Menegembalikan
        return redirect()->route('peta')->with('success', 'Point deleted successfully.');
    }
}
