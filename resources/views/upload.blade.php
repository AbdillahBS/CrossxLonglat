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

                                <div class="theme-toggle d-flex gap-2 align-items-center mt-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" class="iconify iconify--system-uicons" width="20" height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 21 21">
                                        <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M10.5 14.5c2.219 0 4-1.763 4-3.982a4.003 4.003 0 0 0-4-4.018c-2.219 0-4 1.781-4 4c0 2.219 1.781 4 4 4zM4.136 4.136L5.55 5.55m9.9 9.9l1.414 1.414M1.5 10.5h2m14 0h2M4.135 16.863L5.55 15.45m9.899-9.9l1.414-1.415M10.5 19.5v-2m0-14v-2" opacity=".3"></path>
                                            <g transform="translate(-210 -1)">
                                                <path d="M220.5 2.5v2m6.5.5l-1.5 1.5"></path>
                                                <circle cx="220.5" cy="11.5" r="4"></circle>
                                                <path d="m214 5l1.5 1.5m5 14v-2m6.5-.5l-1.5-1.5M214 18l1.5-1.5m-4-5h2m14 0h2"></path>
                                            </g>
                                        </g>
                                    </svg>
                                    <div class="form-check form-switch fs-6">
                                        <input class="form-check-input me-0" type="checkbox" id="toggle-dark" style="cursor: pointer">
                                        <label class="form-check-label"></label>
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" class="iconify iconify--mdi" width="20" height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                                        <path fill="currentColor" d="m17.75 4.09l-2.53 1.94l.91 3.06l-2.63-1.81l-2.63 1.81l.91-3.06l-2.53-1.94L12.44 4l1.06-3l1.06 3l3.19.09m3.5 6.91l-1.64 1.25l.59 1.98l-1.7-1.17l-1.7 1.17l.59-1.98L15.75 11l2.06-.05L18.5 9l.69 1.95l2.06.05m-2.28 4.95c.83-.08 1.72 1.1 1.19 1.85c-.32.45-.66.87-1.08 1.27C15.17 23 8.84 23 4.94 19.07c-3.91-3.9-3.91-10.24 0-14.14c.4-.4.82-.76 1.27-1.08c.75-.53 1.93.36 1.85 1.19c-.27 2.86.69 5.83 2.89 8.02a9.96 9.96 0 0 0 8.02 2.89m-1.64 2.02a12.08 12.08 0 0 1-7.8-3.47c-2.17-2.19-3.33-5-3.49-7.82c-2.81 3.14-2.7 7.96.31 10.98c3.02 3.01 7.84 3.12 10.98.31Z"></path>
                                    </svg>
                                </div>
                                <div class="sidebar-toggler x">
                                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="sidebar-menu">
                            <ul class="menu">
                                <li class="sidebar-title">Menu</li>
                                <li class="sidebar-item">
                                    <a href="\" class="sidebar-link">
                                        <i class="bi bi-grid-fill"></i>
                                        <span>Dashboard</span>
                                    </a>
                                </li>
                                <li class="sidebar-item has-sub">
                                    <a href="#" class="sidebar-link">
                                        <i class="bi bi-cart"></i>
                                        <span>Cross Selling</span>
                                    </a>
                                    <ul class="submenu">
                                        <li class="submenu-item">
                                            <a href="cross-selling">
                                                <i class="bi bi-person"></i>
                                                <span>Top Seller</span>
                                            </a>
                                        </li>
                                        <li class="submenu-item">
                                            <a href="maps" class="submenu-link">
                                                <i class="bi bi-map-fill"></i>
                                                <span>Maps</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="sidebar-item active">
                                    <a href="upload-excel-form" class="sidebar-link">
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
        <div class="page-content">
                <h1>Upload Excel File</h1>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <form id="upload-form" action="{{ route('upload.excel') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="file">Choose Excel File:</label>
                        <input type="file" id="file" name="file" class="form-control" accept=".xlsx, .xls, .csv" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </form>
                <!-- Modal -->
                <div class="modal fade" id="sheetModal" tabindex="-1" role="dialog" aria-labelledby="sheetModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="sheetModalLabel">Select Sheet, Columns, and Table</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="import-form" action="{{ route('import.excel') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="sheet">Choose Sheet:</label>
                                        <select id="sheet" name="sheet" class="form-control"></select>
                                    </div>
                                    <div class="form-group">
                                        <label for="columns">Choose Columns:</label>
                                        <div id="columns-container"></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="table_action">Table Action:</label>
                                        <select id="table_action" name="table_action" class="form-control" onchange="toggleTableOptions()">
                                            <option value="create_new">Create New Table</option>
                                            <option value="replace_existing">Replace Existing Table</option>
                                        </select>
                                    </div>
                                    <div class="form-group" id="new_table_name_group">
                                        <label for="new_table_name">New Table Name:</label>
                                        <input type="text" id="new_table_name" name="new_table_name" class="form-control">
                                    </div>
                                    <div class="form-group" id="existing_table_group" style="display: none;">
                                        <label for="existing_table">Choose Existing Table:</label>
                                        <select id="existing_table" name="existing_table" class="form-control">
                                            @foreach ($tables as $table)
                                                <option value="{{ $table }}">{{ $table }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <input type="hidden" name="file" id="hidden-file">
                                    <button type="submit" class="btn btn-primary">Import</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        function toggleTableOptions() {
            var action = document.getElementById('table_action').value;
            if (action === 'create_new') {
                document.getElementById('new_table_name_group').style.display = 'block';
                document.getElementById('existing_table_group').style.display = 'none';
            } else {
                document.getElementById('new_table_name_group').style.display = 'none';
                document.getElementById('existing_table_group').style.display = 'block';
            }
        }

        $(document).ready(function() {
            $('#upload-form').on('submit', function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    url: $(this).attr('action'),
                    method: $(this).attr('method'),
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        console.log('Upload Response:', response); // Logging respons upload
                        $('#sheet').empty();
                        response.sheets.forEach(function(sheet) {
                            $('#sheet').append(new Option(sheet, sheet));
                        });
                        $('#hidden-file').val(response.file);

                        if (response.sheets.length === 1) {
                            loadColumns(response.file, response.sheets[0]);
                        }

                        $('#sheetModal').modal('show');
                    },
                    error: function(response) {
                        console.log('Upload Error:', response); // Logging error upload
                        alert('Error uploading file');
                    }
                });
            });

            $('#sheet').on('change', function() {
                var sheetName = $(this).val();
                var file = $('#hidden-file').val();
                loadColumns(file, sheetName);
            });
        });

        function loadColumns(file, sheetName) {
            $.ajax({
                url: '{{ route('get.columns') }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    file: file,
                    sheet: sheetName
                },
                success: function(response) {
                    console.log('Columns Response:', response); // Logging respons kolom
                    $('#columns-container').empty();
                    response.columns.forEach(function(column) {
                        $('#columns-container').append(
                            '<div class="form-check">' +
                                '<input class="form-check-input" type="checkbox" name="columns[]" value="' + column + '" id="column-' + column + '">' +
                                '<label class="form-check-label" for="column-' + column + '">' + column + '</label>' +
                            '</div>'
                        );
                    });
                },
                error: function(response) {
                    console.log('Columns Error:', response); // Logging error kolom
                    alert('Error fetching columns');
                }
            });
        }
    </script>
</body>

</html>
