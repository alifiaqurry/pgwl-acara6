<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\polylineModel;
use Illuminate\Http\Request;

class PolylineController extends Controller
{
    protected $polyline;

    public function __construct()
    {
        $this->polyline = new polylineModel();
    }

    public function store(Request $request)
    {
         //validasi input
        $request->validate([
            'geometry_polyline' => 'required',
            'name' => 'required',
            'description' => 'required'
        ],[
            'geometry_polyline.required' => 'Field geometry polyline harus diisi',
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
            $name_image = time() . "_polyline." . strtolower($image->getClientOriginalExtension());
            $image->move('storage/images', $name_image);
        } else {
            $name_image = null;
        }

        $data = [
            'geom' => $request->geometry_polyline,
            'name' => $request->name,
            'description' => $request->description,
            'image' => $name_image
        ];

        if (!$this->polyline->create($data)) {
            return redirect()->route('peta')->with('error', 'Failed to save polyline data. Please try again.');
        }


        return redirect()->route('peta')->with('success', 'Polyline saved successfully.');
    }

    public function destroy(string $id)
    {
        //hapus gambar
        $image = $this->polyline->find($id)->image;

        // Cek jika gambar ada, lalu hapus
        if (!$this->polyline->destroy($id)) {
            return redirect()->route('peta')->with('error', 'Failed to delete polyline data. Please try again.');
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
