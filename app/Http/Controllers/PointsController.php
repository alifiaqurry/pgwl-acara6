<?php

namespace App\Http\Controllers;

use App\Models\PointsModel;
use Illuminate\Http\Request;

class PointsController extends Controller
{
    protected $points;

    public function __construct()
    {
        $this->points = new PointsModel();
    }

    public function store(Request $request)
    {
        //validasi input
        $request->validate([
            'geometry_point' => 'required',
            'name' => 'required',
            'description' => 'required'
        ], [
            'geometry_point.required' => 'Field geometry point harus diisi',
            'name.required' => 'Field name harus diisi',
            'description.required' => 'Field description harus diisi',
            'name.string' => 'Field name harus berupa string',
            'description.string' => 'Field description harus berupa string',
            'image.image' => 'File harus berupa file gambar.',
            'image.mimes' => 'File gambar harus berformat jpeg, png, atau jpg.',
            'image.max' => 'Maksimal ukuran file gambar 2MB.',
        ]);

        // Create directory for images if it doesn't exist
        if (!is_dir('storage/images')) {
            mkdir('./storage/images', 0777);
        }

        //Get file image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name_image = time() . "_point." . strtolower($image->getClientOriginalExtension());
            $image->move('storage/images', $name_image);
        } else {
            $name_image = null;
        }

        $data = [
            'geom' => $request->geometry_point,
            'name' => $request->name,
            'description' => $request->description,
            'image' => $name_image
        ];

        dd($data);

        if (!$this->points->create($data)) {
            return redirect()->route('peta')->with('error', 'Failed to save point data. Please try again.');
        }


        return redirect()->route('peta')->with('success', 'Point saved successfully.');
    }

    public function destroy(string $id)
    {
        //hapus gambar
        $image = $this->points->find($id)->image;

        // Cek jika gambar ada, lalu hapus
        if (!$this->points->destroy($id)) {
            return redirect()->route('peta')->with('error', 'Failed to delete point data. Please try again.');
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
