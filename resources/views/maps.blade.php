<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Dashboard - Admin Dashboard</title>
    <link rel="shortcut icon" href="data:image/svg+xml,%3csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%2033%2034'%20fill-rule='evenodd'%20stroke-linejoin='round'%20stroke-miterlimit='2'%3e%3cpath%20d='M3%2027.472c0%204.409%206.18%205.552%2013.5%205.552%207.281%200%2013.5-1.103%2013.5-5.513s-6.179-5.552-13.5-5.552c-7.281%200-13.5%201.103-13.5%205.513z'%20fill='%23435ebe'%20fill-rule='nonzero'/%3e%3ccircle%20cx='16.5'%20cy='8.8'%20r='8.8'%20fill='%2341bbdd'/%3e%3c/svg%3e" type="image/x-icon">
    <link rel="stylesheet" crossorigin href="./assets/compiled/css/app.css">
    <link rel="stylesheet" crossorigin href="./assets/compiled/css/app-dark.css">
    <link rel="stylesheet" crossorigin href="./assets/compiled/css/iconly.css">
    <link rel="stylesheet" href="assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" crossorigin href="./assets/compiled/css/table-datatable-jquery.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"/>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
</head>
<body>
    <div id="app">
        <div class="sidebar">
            <aside>
                <div id="sidebar">
                    <div class="sidebar-wrapper active">
                        <div class="sidebar-header position-relative">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="logo">
                                    <a href="\">
                                        <img src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEiMKy1RCMukOlNp04FX-fCOnphV1j2czNS7zkecA73id7vqZNYR_XsCrb_CO1NsaHst5xrvI0UlReY9JBvRawxBvToNjfg8V6Y4lAbunZMiPNjsSmLHpJzGKZa2ULaQNguBdyLdPzOlRXd5/s320/Ms+Glow.png" alt="Logo" style="width: 150px; height: auto;">
                                    </a>
                                </div>

                                <div class="theme-toggle d-flex gap-2  align-items-center mt-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--system-uicons" width="20" height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 21 21">
                                        <g fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M10.5 14.5c2.219 0 4-1.763 4-3.982a4.003 4.003 0 0 0-4-4.018c-2.219 0-4 1.781-4 4c0 2.219 1.781 4 4 4zM4.136 4.136L5.55 5.55m9.9 9.9l1.414 1.414M1.5 10.5h2m14 0h2M4.135 16.863L5.55 15.45m9.899-9.9l1.414-1.415M10.5 19.5v-2m0-14v-2" opacity=".3"></path>
                                            <g transform="translate(-210 -1)">
                                                <path d="M220.5 2.5v2m6.5.5l-1.5 1.5"></path>
                                                <circle cx="220.5" cy="11.5" r="4"></circle>
                                                <path d="m214 5l1.5 1.5m5 14v-2m6.5-.5l-1.5-1.5M214 18l1.5-1.5m-4-5h2m14 0h2"></path>
                                            </g>
                                        </g>
                                    </svg>
                                    <div class="form-check form-switch fs-6">
                                        <input class="form-check-input  me-0" type="checkbox" id="toggle-dark" style="cursor: pointer">
                                        <label class="form-check-label"></label>
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--mdi" width="20" height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                                        <path fill="currentColor" d="m17.75 4.09l-2.53 1.94l.91 3.06l-2.63-1.81l-2.63 1.81l.91-3.06l-2.53-1.94L12.44 4l1.06-3l1.06 3l3.19.09m3.5 6.91l-1.64 1.25l.59 1.98l-1.7-1.17l-1.7 1.17l.59-1.98L15.75 11l2.06-.05L18.5 9l.69 1.95l2.06.05m-2.28 4.95c.83-.08 1.72 1.1 1.19 1.85c-.32.45-.66.87-1.08 1.27C15.17 23 8.84 23 4.94 19.07c-3.91-3.9-3.91-10.24 0-14.14c.4-.4.82-.76 1.27-1.08c.75-.53 1.93.36 1.85 1.19c-.27 2.86.69 5.83 2.89 8.02a9.96 9.96 0 0 0 8.02 2.89m-1.64 2.02a12.08 12.08 0 0 1-7.8-3.47c-2.17-2.19-3.33-5-3.49-7.82c-2.81 3.14-2.7 7.96.31 10.98c3.02 3.01 7.84 3.12 10.98.31Z">
                                        </path>
                                    </svg>
                                </div>
                                <div class="sidebar-toggler  x">
                                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="sidebar-menu">
                            <ul class="menu">
                                <li class="sidebar-title">Menu</li>
                                <li class="sidebar-item ">
                                    <a href="\" class='sidebar-link'>
                                        <i class="bi bi-grid-fill"></i>
                                        <span>Dashboard</span>
                                    </a>
                                </li>

                                <li class="sidebar-item active has-sub">
                                    <a href="#" class='sidebar-link'>
                                        <i class="bi bi-cart"></i>
                                        <span>Cross Selling</span>
                                    </a>

                                    <ul class="submenu ">
                                        <li class="submenu-item  ">
                                            <a href="cross-selling">
                                                <i class="bi bi-person"></i>
                                                <span>Top Seller</span>
                                            </a>
                                        </li>
                                        <li class="submenu-item active">
                                            <a href="maps" class="submenu-link">
                                                <i class="bi bi-map-fill"></i>
                                                <span>Maps</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="sidebar-item">
                                    <a href="upload-excel-form" class='sidebar-link'>
                                        <i class="bi bi-cloud-arrow-up"></i>
                                        <span>Imports</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </div>
    <div id="main">
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>

        <div class="page-heading">
            <h2>Maps Cross Selling & Longlat</h2>
        </div>
        <div class="page-content">
            <div class="col-12">

                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Lokasi yang paling banyak terjadi</h5>
                    </div>
                    <div class="card-body">
                        <div id="map2" style="height: 600px; width: 100%;"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <div class="card">
                        <div class="card-header">
                            <h4>Cari Seller</h4>
                        </div>
                        <div class="card-body">
                            <form id="locationForm">
                                <div class="form-group">
                                    <label for="longitude">Longitude:</label>
                                    <input type="text" id="longitude" name="longitude" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="latitude">Latitude:</label>
                                    <input type="text" id="latitude" name="latitude" class="form-control" required>
                                </div>
                                <button type="submit" class="btn btn-primary mt-3">Find Sellers</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-9">
                    <div class="card">
                        <div class="card-header">
                            <h4>Seller pada lokasi Pencarian</h4>
                        </div>
                        <div class="card-body">
                            <table class="table" id="sellersTable">
                                <thead>
                                    <tr>
                                        <th>Kode Seller</th>
                                        <th>Nama Seller</th>
                                        <th>Tanggal Terbaru</th>
                                        <th>Jumlah di Kejadian</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($locationSellers as $seller)
                                        <tr>
                                            <td>{{ $seller->kode }}</td>
                                            <td>{{ $seller->nama }}</td>
                                            <td>{{ $seller->tanggal_baru }}</td>
                                            <td>{{ $seller->count }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <section class="row">
                <div class="col-3">
                    <div class="card">
                        <div class="card-header">
                            <h4>Cari Lokasi Seller</h4>
                        </div>
                        <div class="card-body">
                            <form id="codeForm">
                                <div class="form-group">
                                    <label for="kode">Kode:</label>
                                    <input type="text" id="kode" name="kode" class="form-control" required>
                                </div>
                                <button type="submit" class="btn btn-primary mt-3">Find Locations</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-9">
                    <div class="card">
                        <div class="card-header">
                            <h4>Lokasi untuk kode <span id="kodeHeader"></span> - <span id="namaHeader"></span></h4>
                        </div>
                        <div class="card-body">
                            <div id="map" style="height: 500px; width: 100%;"></div>
                        </div>
                    </div>
                </div>

            </div>
            </section>


        <footer>
            <div class="footer clearfix mb-0 text-muted">
                <div class="float-start">
                    <p>2024 &copy; MS Glow</p>
                </div>
            </div>
        </footer>
    </div>

    <script src="assets/static/js/components/dark.js"></script>
    <script src="assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/compiled/js/app.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="assets/extensions/jquery/jquery.min.js"></script>
    <script src="assets/extensions/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="assets/extensions/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
    <script src="assets/static/js/pages/datatables.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var frequentLocations = @json($frequentLocations);
            // Define a marker icon
            var blueIcon = new L.Icon({
                iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-blue.png',
                shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
            });

            // Initialize the second map
            var map2 = L.map('map2').setView([-2.5489, 118.0149], 5);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map2);

            // Add markers to the second map
            frequentLocations.forEach(function (location) {
                var lat = parseFloat(location.latitude);
                var lng = parseFloat(location.longitude);
                if (!isNaN(lat) && !isNaN(lng)) {
                    var marker = L.marker([lat, lng], { icon: blueIcon }).addTo(map2);
                    marker.bindPopup(`<strong>Jumlah Seller:</strong> ${location.count}<br><strong>Longlat:</strong> ${location.longitude}, ${location.latitude}`);
                }
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('locationForm').addEventListener('submit', function(event) {
                event.preventDefault();
                var latitude = document.getElementById('latitude').value.trim();
                var longitude = document.getElementById('longitude').value.trim();

                fetch(`/api/get-location-sellers?latitude=${latitude}&longitude=${longitude}`)
                    .then(response => response.json())
                    .then(data => {
                        var table = $('#sellersTable').DataTable();
                        table.clear();
                        data.forEach(seller => {
                            table.row.add([
                                seller.kode,
                                seller.nama,
                                seller.tanggal_baru,
                                seller.count
                            ]).draw(false);
                        });
                    })
                    .catch(error => console.error('Error fetching data:', error));
            });

            // Initialize DataTable on page load
            $('#sellersTable').DataTable();
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var map = L.map('map').setView([-2.5489, 118.0149], 5);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

            var blueIcon = L.icon({
                iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-blue.png',
                shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
            });

            document.getElementById('codeForm').addEventListener('submit', function(event) {
                event.preventDefault();
                var kode = document.getElementById('kode').value.trim();

                fetch(`/api/get-locations-by-kode?kode=${kode}`)
                    .then(response => response.json())
                    .then(data => {
                        console.log(data); // Log the response data

                        if (data.length > 0) {
                            // Update the card header with the code and name
                            document.getElementById('kodeHeader').textContent = kode;
                            document.getElementById('namaHeader').textContent = data[0].nama ? data[0].nama : 'Nama tidak ditemukan';

                            // Clear existing markers
                            map.eachLayer(function (layer) {
                                if (!!layer.toGeoJSON) {
                                    map.removeLayer(layer);
                                }
                            });
                            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                attribution: '© OpenStreetMap contributors'
                            }).addTo(map);

                            // Add new markers
                            data.forEach(location => {
                                var lat = parseFloat(location.latitude);
                                var lng = parseFloat(location.longitude);
                                if (!isNaN(lat) && !isNaN(lng)) {
                                    var marker = L.marker([lat, lng], { icon: blueIcon }).addTo(map);
                                    marker.bindPopup(`<strong>Location:</strong> ${lat}, ${lng}<br><strong>Date:</strong> ${location.tanggal}<br><strong>Count:</strong> ${location.count}`);
                                }
                            });
                        } else {
                            document.getElementById('kodeHeader').textContent = kode;
                            document.getElementById('namaHeader').textContent = 'Data tidak ditemukan';
                        }
                    })
                    .catch(error => console.error('Error fetching data:', error));
            });
        });
        </script>



</body>
</html>
