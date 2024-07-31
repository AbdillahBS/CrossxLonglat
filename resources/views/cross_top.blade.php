<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Dashboard - Admin Dashboard</title>
    <link rel="shortcut icon" href="data:image/svg+xml,%3csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%2033%2034'%20fill-rule='evenodd'%20stroke-linejoin='round'%20stroke-miterlimit='2'%20xmlns:v='https://vecta.io/nano'%3e%3cpath%20d='M3%2027.472c0%204.409%206.18%205.552%2013.5%205.552%207.281%200%2013.5-1.103%2013.5-5.513s-6.179-5.552-13.5-5.552c-7.281%200-13.5%201.103-13.5%205.513z'%20fill='%23435ebe'%20fill-rule='nonzero'/%3e%3ccircle%20cx='16.5'%20cy='8.8'%20r='8.8'%20fill='%2341bbdd'/%3e%3c/svg%3e" type="image/x-icon">
    <link rel="shortcut icon" href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACEAAAAiCAYAAADRcLDBAAAEs2lUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4KPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iWE1QIENvcmUgNS41LjAiPgogPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4KICA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIgogICAgeG1sbnM6ZXhpZj0iaHR0cDovL25zLmFkb2JlLmNvbS9leGlmLzEuMC8iCiAgICB4bWxuczp0aWZmPSJodHRwOi8vbnMuYWRvYmUuY29tL3RpZmYvMS4wLyIKICAgIHhtbG5zOnBob3Rvc2hvcD0iaHR0cDovL25zLmFkb2JlLmNvbS9waG90b3Nob3AvMS4wLyIKICAgIHhtbG5zOnhtcD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLyIKICAgIHhtbG5zOnhtcE1NPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvbW0vIgogICAgeG1sbnM6c3RFdnQ9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZUV2ZW50IyIKICAgZXhpZjpQaXhlbFhEaW1lbnNpb249IjMzIgogICBleGlmOlBpeGVsWURpbWVuc2lvbj0iMzQiCiAgIGV4aWY6Q29sb3JTcGFjZT0iMSIKICAgdGlmZjpJbWFnZVdpZHRoPSIzMyIKICAgdGlmZjpJbWFnZUxlbmd0aD0iMzQiCiAgIHRpZmY6UmVzb2x1dGlvblVuaXQ9IjIiCiAgIHRpZmY6WFJlc29sdXRpb249Ijk2LjAiCiAgIHRpZmY6WVJlc29sdXRpb249Ijk2LjAiCiAgIHBob3Rvc2hvcDpDb2xvck1vZGU9IjMiCiAgIHBob3Rvc2hvcDpJQ0NQcm9maWxlPSJzUkdCIElFQzYxOTY2LTIuMSIKICAgeG1wOk1vZGlmeURhdGU9IjIwMjItMDMtMzFUMTA6NTA6MjMrMDI6MDAiCiAgIHhtcDpNZXRhZGF0YURhdGU9IjIwMjItMDMtMzFUMTA6NTA6MjMrMDI6MDAiPgogICA8eG1wTU06SGlzdG9yeT4KICAgIDxyZGY6U2VxPgogICAgIDxyZGY6bGkKICAgICAgc3RFdnQ6YWN0aW9uPSJwcm9kdWNlZCIKICAgICAgc3RFdnQ6c29mdHdhcmVBZ2VudD0iQWZmaW5pdHkgRGVzaWduZXIgMS4xMC4xIgogICAgICBzdEV2dDp3aGVuPSIyMDIyLTAzLTMxVDEwOjUwOjIzKzAyOjAwIi8+CiAgICA8L3JkZjpTZXE+CiAgIDwveG1wTU06SGlzdG9yeT4KICA8L3JkZjpEZXNjcmlwdGlvbj4KIDwvcmRmOlJERj4KPC94OnhtcG1ldGE+Cjw/eHBhY2tldCBlbmQ9InIiPz5V57uAAAABgmlDQ1BzUkdCIElFQzYxOTY2LTIuMQAAKJF1kc8rRFEUxz9maORHo1hYKC9hISNGTWwsRn4VFmOUX5uZZ36oeTOv954kW2WrKLHxa8FfwFZZK0WkZClrYoOe87ypmWTO7dzzud97z+nec8ETzaiaWd4NWtYyIiNhZWZ2TvE946WZSjqoj6mmPjE1HKWkfdxR5sSbgFOr9Ll/rXoxYapQVik8oOqGJTwqPL5i6Q5vCzeo6dii8KlwpyEXFL519LjLLw6nXP5y2IhGBsFTJ6ykijhexGra0ITl5bRqmWU1fx/nJTWJ7PSUxBbxJkwijBBGYYwhBgnRQ7/MIQIE6ZIVJfK7f/MnyUmuKrPOKgZLpEhj0SnqslRPSEyKnpCRYdXp/9++msneoFu9JgwVT7b91ga+LfjetO3PQ9v+PgLvI1xkC/m5A+h7F32zoLXug38dzi4LWnwHzjeg8UGPGbFfySvuSSbh9QRqZ6H+Gqrm3Z7l9zm+h+iafNUV7O5Bu5z3L/wAdthn7QIme0YAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAJTSURBVFiF7Zi9axRBGIefEw2IdxFBRQsLWUTBaywSK4ubdSGVIY1Y6HZql8ZKCGIqwX/AYLmCgVQKfiDn7jZeEQMWfsSAHAiKqPiB5mIgELWYOW5vzc3O7niHhT/YZvY37/swM/vOzJbIqVq9uQ04CYwCI8AhYAlYAB4Dc7HnrOSJWcoJcBS4ARzQ2F4BZ2LPmTeNuykHwEWgkQGAet9QfiMZjUSt3hwD7psGTWgs9pwH1hC1enMYeA7sKwDxBqjGnvNdZzKZjqmCAKh+U1kmEwi3IEBbIsugnY5avTkEtIAtFhBrQCX2nLVehqyRqFoCAAwBh3WGLAhbgCRIYYinwLolwLqKUwwi9pxV4KUlxKKKUwxC6ZElRCPLYAJxGfhSEOCz6m8HEXvOB2CyIMSk6m8HoXQTmMkJcA2YNTHm3congOvATo3tE3A29pxbpnFzQSiQPcB55IFmFNgFfEQeahaAGZMpsIJIAZWAHcDX2HN+2cT6r39GxmvC9aPNwH5gO1BOPFuBVWAZue0vA9+A12EgjPadnhCuH1WAE8ivYAQ4ohKaagV4gvxi5oG7YSA2vApsCOH60WngKrA3R9IsvQUuhIGY00K4flQG7gHH/mLytB4C42EgfrQb0mV7us8AAMeBS8mGNMR4nwHamtBB7B4QRNdaS0M8GxDEog7iyoAguvJ0QYSBuAOcAt71Kfl7wA8DcTvZ2KtOlJEr+ByyQtqqhTyHTIeB+ONeqi3brh+VgIN0fohUgWGggizZFTplu12yW8iy/YLOGWMpDMTPXnl+Az9vj2HERYqPAAAAAElFTkSuQmCC" type="image/png">
    <link rel="stylesheet" crossorigin href="./assets/compiled/css/app.css">
    <link rel="stylesheet" crossorigin href="./assets/compiled/css/app-dark.css">
    <link rel="stylesheet" crossorigin href="./assets/compiled/css/iconly.css">
    <link rel="stylesheet" href="assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" crossorigin href="./assets/compiled/css/table-datatable-jquery.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/xlsx@0.16.9/dist/xlsx.full.min.js"></script>
</head>

<body>
    <script src="assets/static/js/initTheme.js"></script>
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
                                        <li class="submenu-item active ">
                                            <a href="cross-selling">
                                                <i class="bi bi-person"></i>
                                                <span>Top Seller</span>
                                            </a>
                                        </li>
                                        <li class="submenu-item ">
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
            <h3>Top Cross Selling & Longlat</h3>
        </div>
        <div class="page-content">
           <section class="row">
                <div class="col-6 ">
                    <div class="card">
                        <div class="card-header">
                            <h4>Top Seller Cross Selling</h4>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-end mb-3">
                                <button id="exportActivityChartSVG" class="btn btn-primary me-2">Export SVG</button>
                                <button id="exportActivityChartPNG" class="btn btn-success me-2">Export PNG</button>
                                <button id="exportActivityChartExcel" class="btn btn-warning">Export Excel</button>
                            </div>
                            <canvas id="activityChart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-6 ">
                    <div class="card">
                        <div class="card-header">
                            <h4>Top Seller pada Longlat</h4>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-end mb-3">
                                <button id="exportLocationChartSVG" class="btn btn-primary me-2">Export SVG</button>
                                <button id="exportLocationChartPNG" class="btn btn-success me-2">Export PNG</button>
                                <button id="exportLocationChartExcel" class="btn btn-warning">Export Excel</button>
                            </div>
                            <canvas id="locationChart"></canvas>
                        </div>
                    </div>
                </div>
            </section>

            <section class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Perbandingan antara Seller cross selling dan Longlat yang Sama</h4>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-end mb-3">
                                <button id="exportTopSellersLonglatChartSVG" class="btn btn-primary me-2">Export SVG</button>
                                <button id="exportTopSellersLonglatChartPNG" class="btn btn-success me-2">Export PNG</button>
                                <button id="exportTopSellersLonglatChartExcel" class="btn btn-warning">Export Excel</button>
                            </div>
                            <canvas id="topSellersLonglatChart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Interaksi Top Pelaku dan Pembeli</h4>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-end mb-3">
                                <button id="exportKeyInteractionsChartSVG" class="btn btn-primary me-2">Export SVG</button>
                                <button id="exportKeyInteractionsChartPNG" class="btn btn-success me-2">Export PNG</button>
                                <button id="exportKeyInteractionsChartExcel" class="btn btn-warning">Export Excel</button>
                            </div>
                            <canvas id="keyInteractionsChart"></canvas>
                        </div>
                    </div>
                </div>
            </section>
            <section class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Top Accurate Interaksi Pelaku & Pembeli</h4>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-start mb-3">
                            <button id="exportTabelInteractionsExcel" class="btn btn-danger">Export Excel</button>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped" id="table2">
                                    <thead>
                                        <tr>
                                            <th>ID Owner</th>
                                            <th>Nama Owner</th>
                                            <th>ID Pembeli</th>
                                            <th>Nama Pembeli</th>
                                            <th>Tanggal</th>
                                            <th>Longlat</th>
                                            <th>Jumlah Kejadian</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($tableInteractions as $interaction)
                                            <tr>
                                                <td>{{ $interaction['id_owner'] }}</td>
                                                <td>{{ $interaction['nama_owner'] }}</td>
                                                <td>{{ $interaction['id_pembeli'] }}</td>
                                                <td>{{ $interaction['nama_pembeli'] }}</td>
                                                <td>{{ $interaction['tanggal'] }}</td>
                                                <td>{{ $interaction['longlat'] }}</td>
                                                <td>{{ $interaction['jumlah_kejadian'] }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </section>

        </div>

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



    <!-- Need: Apexcharts -->
    <script src="assets/extensions/apexcharts/apexcharts.min.js"></script>
    <script src="assets/static/js/pages/dashboard.js"></script>
    <script src="assets/static/js/pages/ui-apexchart.js"></script>
    <script src="assets/extensions/jquery/jquery.min.js"></script>
    <script src="assets/extensions/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="assets/extensions/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
    <script src="assets/static/js/pages/datatables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
       document.addEventListener('DOMContentLoaded', function() {
    // top cross
    var ctxActivity = document.getElementById('activityChart');
    if (ctxActivity) {
        var activitySummary = {!! json_encode($topActivityData) !!};
        var fullcrossdata = {!! json_encode($fullcrossdata) !!};
        var activityLabels = Object.keys(activitySummary);
        var activityData = Object.values(activitySummary);
        var crossNames = {};

        // Membuat dictionary untuk kode -> nama
        fullcrossdata.forEach(function(item) {
            crossNames[item.id_owner] = item.nama_owner;
        });

        var activityChart = new Chart(ctxActivity.getContext('2d'), {
            type: 'bar',
            data: {
                labels: activityLabels,
                datasets: [{
                    label: 'Jumlah Aktivasi',
                    data: activityData,
                    backgroundColor: '#36A2EB',
                    borderColor: '#36A2EB',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                    callbacks: {
                        label: function(context) {
                            var label = context.dataset.label || '';
                            if (label) {
                                label += ': ';
                            }
                            label += context.raw;
                            label += ' (Nama: ' + crossNames[context.label] + ')';
                            return label;
                        }
                    }
                }
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'ID Penyuplai'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Jumlah Aktivasi'
                        },
                        beginAtZero: true
                    }
                }
            }
        });

        document.getElementById('exportActivityChartSVG').addEventListener('click', function() {
            var svgUrl = ctxActivity.toDataURL("image/svg+xml");
            var downloadLink = document.createElement('a');
            downloadLink.href = svgUrl;
            downloadLink.download = 'activity_chart.svg';
            downloadLink.click();
        });

        document.getElementById('exportActivityChartPNG').addEventListener('click', function() {
            var pngUrl = ctxActivity.toDataURL("image/png");
            var downloadLink = document.createElement('a');
            downloadLink.href = pngUrl;
            downloadLink.download = 'activity_chart.png';
            downloadLink.click();
        });

        document.getElementById('exportActivityChartExcel').addEventListener('click', function() {
            var worksheet = XLSX.utils.aoa_to_sheet([

            ['ID Penyuplai', 'Nama', 'Jumlah Aktivasi'],
            ...fullcrossdata.map((item) => [item.id_owner, item.nama_owner, item.total])
        ]);
            var workbook = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(workbook, worksheet, 'Activity Chart');
            XLSX.writeFile(workbook, 'activity_chart.xlsx');
        });
    } else {
        console.error('Element with id "activityChart" not found');
    }

    // top longlat
    var ctxLocation = document.getElementById('locationChart');
    if (ctxLocation) {
    var locationSummary = {!! json_encode($topLocationData) !!};
    var fullLocationData = {!! json_encode($fullLocationData) !!};
    var locationLabels = Object.keys(locationSummary);
    var locationData = Object.values(locationSummary);
    var locationNames = {};

    // Membuat dictionary untuk kode -> nama
    fullLocationData.forEach(function(item) {
        locationNames[item.kode] = item.nama;
    });

    var locationChart = new Chart(ctxLocation.getContext('2d'), {
        type: 'bar',
        data: {
            labels: locationLabels,
            datasets: [{
                label: 'Jumlah di Kejadian',
                data: locationData,
                backgroundColor: '#FFCE56',
                borderColor: '#FFCE56',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            var label = context.dataset.label || '';
                            if (label) {
                                label += ': ';
                            }
                            label += context.raw;
                            label += ' (Nama: ' + locationNames[context.label] + ')';
                            return label;
                        }
                    }
                }
            },
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Pelaku'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Jumlah di Kejadian'
                    },
                    beginAtZero: true
                }
            }
        }
    });

    document.getElementById('exportLocationChartSVG').addEventListener('click', function() {
        var svgUrl = ctxLocation.toDataURL("image/svg+xml");
        var downloadLink = document.createElement('a');
        downloadLink.href = svgUrl;
        downloadLink.download = 'location_chart.svg';
        downloadLink.click();
    });

    document.getElementById('exportLocationChartPNG').addEventListener('click', function() {
        var pngUrl = ctxLocation.toDataURL("image/png");
        var downloadLink = document.createElement('a');
        downloadLink.href = pngUrl;
        downloadLink.download = 'location_chart.png';
        downloadLink.click();
    });

    document.getElementById('exportLocationChartExcel').addEventListener('click', function() {
        var worksheet = XLSX.utils.aoa_to_sheet([
            ['Kode', 'Nama', 'Jumlah di Kejadian'],
            ...fullLocationData.map((item) => [item.kode, item.nama, item.total])
        ]);
        var workbook = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(workbook, worksheet, 'Location Chart');
        XLSX.writeFile(workbook, 'location_chart.xlsx');
    });
} else {
    console.error('Element with id "locationChart" not found');
}



    // Top persamaan
    var ctxTopSellersLonglat = document.getElementById('topSellersLonglatChart');
    if (ctxTopSellersLonglat) {
        var topSellersLonglat = {!! json_encode($commonSellersCount) !!};
        var longlatLabels = Object.keys(topSellersLonglat);
        var longlatData = Object.values(topSellersLonglat);

        var longlatChart = new Chart(ctxTopSellersLonglat.getContext('2d'), {
            type: 'bar',
            data: {
                labels: longlatLabels,
                datasets: [{
                    label: 'Jumlah yang Sama',
                    data: longlatData,
                    backgroundColor: '#FFCE56',
                    borderColor: '#FFCE56',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    },
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Pelaku (ID Seller)'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Jumlah yang Sama'
                        },
                        beginAtZero: true
                    }
                }
            }
        });

        document.getElementById('exportTopSellersLonglatChartSVG').addEventListener('click', function() {
            var svgUrl = ctxTopSellersLonglat.toDataURL("image/svg+xml");
            var downloadLink = document.createElement('a');
            downloadLink.href = svgUrl;
            downloadLink.download = 'top_sellers_longlat_chart.svg';
            downloadLink.click();
        });

        document.getElementById('exportTopSellersLonglatChartPNG').addEventListener('click', function() {
            var pngUrl = ctxTopSellersLonglat.toDataURL("image/png");
            var downloadLink = document.createElement('a');
            downloadLink.href = pngUrl;
            downloadLink.download = 'top_sellers_longlat_chart.png';
            downloadLink.click();
        });

        document.getElementById('exportTopSellersLonglatChartExcel').addEventListener('click', function() {
            var worksheet = XLSX.utils.aoa_to_sheet([
                ['Pelaku (ID Seller)', 'Jumlah yang Sama'],
                ...longlatLabels.map((label, index) => [label, longlatData[index]])
            ]);
            var workbook = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(workbook, worksheet, 'Top Sellers Longlat Chart');
            XLSX.writeFile(workbook, 'top_sellers_longlat_chart.xlsx');
        });
    } else {
        console.error('Element with id "topSellersLonglatChart" not found');
    }

    // Key Interactions Chart
    var ctxKeyInteractions = document.getElementById('keyInteractionsChart');
    if (ctxKeyInteractions) {
        var keyInteractions = {!! json_encode($keyInteractions) !!};
        var interactionLabels = Object.keys(keyInteractions).map(key => key.split(' & ').slice(0, 2).join(' & ')); // Exclude date for chart labels
        var interactionData = Object.values(keyInteractions);

        // Limit to top 10 interactions for chart display
        var limitedLabels = interactionLabels.slice(0, 10);
        var limitedData = interactionData.slice(0, 10);

        var keyInteractionsChart = new Chart(ctxKeyInteractions.getContext('2d'), {
            type: 'bar',
            data: {
                labels: limitedLabels,
                datasets: [{
                    label: 'Jumlah Kejadian',
                    data: limitedData,
                    backgroundColor: 'skyblue',
                    borderColor: 'skyblue',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    },
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Pelaku dan Pembeli'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Jumlah Kejadian'
                        },
                        beginAtZero: true
                    }
                }
            }
        });

        document.getElementById('exportKeyInteractionsChartSVG').addEventListener('click', function() {
            var svgUrl = ctxKeyInteractions.toDataURL("image/svg+xml");
            var downloadLink = document.createElement('a');
            downloadLink.href = svgUrl;
            downloadLink.download = 'key_interactions_chart.svg';
            downloadLink.click();
        });

        document.getElementById('exportKeyInteractionsChartPNG').addEventListener('click', function() {
            var pngUrl = ctxKeyInteractions.toDataURL("image/png");
            var downloadLink = document.createElement('a');
            downloadLink.href = pngUrl;
            downloadLink.download = 'key_interactions_chart.png';
            downloadLink.click();
        });

        document.getElementById('exportKeyInteractionsChartExcel').addEventListener('click', function() {
        var worksheetData = [
            ['Pelaku', 'Nama Pelaku', 'Pembeli', 'Nama Pembeli', 'Tanggal', 'Longlat', 'Jumlah Kejadian']
        ];

        Object.keys(keyInteractions).forEach((label, index) => {
            var [pelaku, pembeli, tanggal, namaPelaku, namaPembeli, longitudePelaku, latitudePelaku] = label.split(' & ');

            var longlatPelaku = longitudePelaku && latitudePelaku ? `${longitudePelaku}, ${latitudePelaku}` : '';

            worksheetData.push([
                pelaku,
                namaPelaku,
                pembeli,
                namaPembeli,
                tanggal,
                longlatPelaku,
                interactionData[index]
            ]);
        });

        var worksheet = XLSX.utils.aoa_to_sheet(worksheetData);
        var workbook = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(workbook, worksheet, 'Key Interactions Chart');
        XLSX.writeFile(workbook, 'key_interactions_chart.xlsx');
    });
    } else {
        console.error('Element with id "keyInteractionsChart" not found');
    }
    });
    </script>
    <script>
        document.getElementById('exportTabelInteractionsExcel').addEventListener('click', function() {
            var tableInteractions = {!! json_encode($tableInteractions) !!};
            var worksheetData = [
                ['ID Owner', 'Nama Owner', 'ID Pembeli', 'Nama Pembeli', 'Tanggal', 'Longlat', 'Jumlah Kejadian']
            ];

            tableInteractions.forEach((interaction) => {
                worksheetData.push([
                    interaction.id_owner,
                    interaction.nama_owner,
                    interaction.id_pembeli,
                    interaction.nama_pembeli,
                    interaction.tanggal,
                    interaction.longlat,
                    interaction.jumlah_kejadian
                ]);
            });

            var worksheet = XLSX.utils.aoa_to_sheet(worksheetData);
            var workbook = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(workbook, worksheet, 'Tabel Interactions');
            XLSX.writeFile(workbook, 'tabel_interactions.xlsx');
        });
        </script>






</body>

</html>
