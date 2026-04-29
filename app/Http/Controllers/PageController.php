<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function tabel()
    {
        $data = [
            'title' => 'tabel',
        ];
        return view('table', $data);
    }
    public function peta()
    {
        $data = [
            'title' => 'peta',
        ];
        return view('map', $data);
    }
}
