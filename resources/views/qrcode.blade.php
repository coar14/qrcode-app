<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code Generator</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .qr-code-container img {
            max-width: 150px;
            margin: 10px;
        }
        .form-section {
            margin-bottom: 20px;
        }
        .form-section label {
            font-weight: bold;
        }
        .form-section button {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">QR Code Generator</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- QR Code Generation Form -->
        <div class="form-section">
            <h2>Generate QR Codes</h2>
            <form action="{{ route('qrcode.generate') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="start">Start Number:</label>
                    <input type="number" name="start" id="start" class="form-control" value="1" required>
                </div>
                <div class="form-group">
                    <label for="end">End Number:</label>
                    <input type="number" name="end" id="end" class="form-control" value="999" required>
                </div>
                <div class="form-group">
                    <label for="label">Label:</label>
                    <input type="text" name="label" id="label" class="form-control" value="Code" required>
                </div>
                <button type="submit" class="btn btn-primary">Generate QR Codes</button>
            </form>
        </div>

        <!-- QR Code Display Section -->
        <div class="form-section">
            <h2>Existing QR Codes</h2>
            <div class="row qr-code-container">
                @foreach ($qrCodes as $qrCode)
                    <div class="col-md-3">
                        <img src="{{ Storage::url($qrCode) }}" alt="QR Code" class="img-thumbnail">
                    </div>
                @endforeach
            </div>
        </div>

        <!-- QR Code Deletion Form -->
        <div class="form-section">
            <h2>Delete All QR Codes</h2>
            <form action="{{ route('qrcode.delete') }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete All QR Codes</button>
            </form>
        </div>

        <!-- CSV Download Form -->
        <div class="form-section">
            <h2>Download QR Code CSV</h2>
            <form action="{{ route('qrcode.downloadCsv') }}" method="GET">
                <div class="form-group">
                    <label for="csv_start">Start Number:</label>
                    <input type="number" name="start" id="csv_start" class="form-control" value="1" required>
                </div>
                <div class="form-group">
                    <label for="csv_end">End Number:</label>
                    <input type="number" name="end" id="csv_end" class="form-control" value="999" required>
                </div>
                <div class="form-group">
                    <label for="csv_label">Label:</label>
                    <input type="text" name="label" id="csv_label" class="form-control" value="Code" required>
                </div>
                <button type="submit" class="btn btn-info">Download CSV</button>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
