@extends('layouts.template')

@section('styles')
    <style>
        #map {
            height: 100vh;
            width: 100%;
        }

        body {
            padding: 0;
            margin: 0;
        }
    </style>
@endsection

@section('content')
        <div class="container mt-4">
            <div class="card">
                <div class="card-header">
                    <h3>Tabel Data</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Deskripsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Keraton Yogyakarta</td>
                                <td>Jl Taman Sari</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Gembiraloka</td>
                                <td>Jl Pancasila</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Alun Alun Kidul</td>
                                <td>Jl Mataram</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
@endsection