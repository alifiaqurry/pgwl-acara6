@extends('layouts.template')

@section('styles')
    {{-- Leaflet CSS --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.css">
    <style>

        body, html {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
            overflow: hidden;
        }
        #map {
            height: calc(100vh - 56px);
            width: 100%;
        }
    </style>
@endsection

@section('content')
    <div id="map"></div>

    {{-- Modal Input Point --}}
    <div class="modal fade" id="modalInputPoint" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Input title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('point.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Fill name here...">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="geometry_point" class="form-label">Geometry</label>
                            <textarea class="form-control" id="geometry_point" name="geometry_point" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" class="form-control" id="image" name="image"
                            onchange="document.getElementById('preview-image-point').src = window.URL.createObjectURL(this.files[0])">
                        </div>
                        <div class="mb-3">
                        <img src="" alt="" id="preview-image-point" class="img-thumbnail" width="400">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Input Polyline --}}
    <div class="modal fade" id="modalInputPolyline" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Input Polyline</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('polyline.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Fill name here...">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="geometry_polyline" class="form-label">Geometry</label>
                            <textarea class="form-control" id="geometry_polyline" name="geometry_polyline" rows="3"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" class="form-control" id="image" name="image"
                            onchange="document.getElementById('preview-image-polyline').src = window.URL.createObjectURL(this.files[0])">
                        </div>
                        <div class="mb-3">
                        <img src="" alt="" id="preview-image-polyline" class="img-thumbnail" width="400">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Input Polygon --}}
    <div class="modal fade" id="modalInputPolygon" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Input Polygon</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('polygon.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Fill name here...">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="geometry_polygon" class="form-label">Geometry</label>
                            <textarea class="form-control" id="geometry_polygon" name="geometry_polygon" rows="3"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" class="form-control" id="image" name="image"
                            onchange="document.getElementById('preview-image-polygon').src = window.URL.createObjectURL(this.files[0])">
                        </div>
                        <div class="mb-3">
                        <img src="" alt="" id="preview-image-polygon" class="img-thumbnail" width="400">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    {{-- Leaflet JS --}}
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    {{-- Leaflet Draw JS --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js"></script>

    {{-- Terraformer WKT --}}
    <script src="https://unpkg.com/@terraformer/wkt"></script>

    {{-- jQuery --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script>
        // Inisialisasi peta dan atur tampilan ke koordinat Yogyakarta
        var map = L.map('map').setView([-7.7956, 110.3695], 13); // Latitude, Longitude, Zoom Level

        // Tambahkan tile layer OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        /* Digitize Function */
        var drawnItems = new L.FeatureGroup();
        map.addLayer(drawnItems);

        var drawControl = new L.Control.Draw({
            draw: {
                position: 'topleft',
                polyline: true,
                polygon: true,
                rectangle: true,
                circle: false,
                marker: true,
                circlemarker: false
            },
            edit: false
        });

        map.addControl(drawControl);

        map.on('draw:created', function(e) {
            var type = e.layerType,
                layer = e.layer;

            console.log(type);

            var drawnJSONObject = layer.toGeoJSON();
            var objectGeometry = Terraformer.geojsonToWKT(drawnJSONObject.geometry);

            console.log(drawnJSONObject);
            console.log(objectGeometry);


            if (type === 'polyline') {

                //Set value geometry to geometry polyline textarea
                $('#geometry_polyline').val(objectGeometry);
                //Show Modal Input Polyline
                $('#modalInputPolyline').modal('show');
                //Modal dismiss reload page
                $('#modalInputPolyline').on('hidden.bs.modal', function() {
                    location.reload();
                });

            } else if (type === 'polygon' || type === 'rectangle') {
                //Set value geometry to geometry polygon textarea
                $('#geometry_polygon').val(objectGeometry);
                //Show Modal Input Polygon
                $('#modalInputPolygon').modal('show');

                //Modal dismiss reload page
                $('#modalInputPolygon').on('hidden.bs.modal', function() {
                    location.reload();
                });

            } else if (type === 'marker') {

                //Set value geometry to geometry point textarea
                $('#geometry_point').val(objectGeometry);
                //Show Modal Input Point
                $('#modalInputPoint').modal('show');

                //Modal dismiss reload page
                $('#modalInputPoint').on('hidden.bs.modal', function() {
                    location.reload();
                });

            } else {
                console.log('__undefined__');
            }
            drawnItems.addLayer(layer);
        });

        //point layer
        // GeoJSON Points
        var points = L.geoJSON(null, {
            // Style

            // onEachFeature

            onEachFeature: function(feature, layer) {
                // variable popup content
                var popup_content = "Nama: " + feature.properties.name + "<br>" +
                    "Deskripsi: " + feature.properties.description + "<br>" +
                    "Dibuat pada: " + feature.properties.created_at + "<br>" +
                    "<img src='{{ asset('storage/images/') }}/" + feature.properties.image +
                    "' alt='' class='img-thumbnail' width='400'>";

                layer.on({
                    click: function(e) {
                        points.bindPopup(popup_content);
                    },
                });
            },

        });

        $.getJSON("{{ route('geojson.points') }}", function(data) {
            points.addData(data); // Menambahkan data ke dalam GeoJSON Point
            map.addLayer(points); // Menambahkan GeoJSON Point  ke dalam peta
        });

        //polyline layer
        //point layer
        // GeoJSON Points
        var polyline = L.geoJSON(null, {
            // Style

            // onEachFeature

            onEachFeature: function(feature, layer) {
                // variable popup content
                var popup_content = "Nama: " + feature.properties.name + "<br>" +
                    "Deskripsi: " + feature.properties.description + "<br>" +
                    "Dibuat pada: " + feature.properties.created_at + "<br>" +  "<img src='{{ asset('storage/images/') }}/" + feature.properties.image +
                    "' alt='' class='img-thumbnail' width='400'>";

                layer.on({
                    click: function(e) {
                        polyline.bindPopup(popup_content);
                    },
                });
            },

        });

        $.getJSON("{{ route('geojson.polyline') }}", function(data) {
            polyline.addData(data); // Menambahkan data ke dalam GeoJSON Polyline
            map.addLayer(polyline); // Menambahkan GeoJSON Polyline  ke dalam peta
        });

        //polygon layer
        // GeoJSON Points
        var polygon = L.geoJSON(null, {
            // Style

            // onEachFeature

            onEachFeature: function(feature, layer) {
                // variable popup content
                var popup_content = "Nama: " + feature.properties.name + "<br>" +
                    "Deskripsi: " + feature.properties.description + "<br>" +
                    "Dibuat pada: " + feature.properties.created_at + "<br>" + "<img src='{{ asset('storage/images/') }}/" + feature.properties.image +
                    "' alt='' class='img-thumbnail' width='400'>";

                layer.on({
                    click: function(e) {
                        polygon.bindPopup(popup_content);
                    },
                });
            },

        });

        $.getJSON("{{ route('geojson.polygon') }}", function(data) {
            polygon.addData(data); // Menambahkan data ke dalam GeoJSON Polygon
            map.addLayer(polygon); // Menambahkan GeoJSON Polygon  ke dalam peta
        });

        // Control Layer
        var baseMaps = {
          //j
        };

        var overlayMaps = {
            "Points": points,
            "Polyline": polyline,
            "Polygon": polygon,
        };

        var controllayer = L.control.layers(baseMaps, overlayMaps);
        controllayer.addTo(map);
    </script>
@endsection
