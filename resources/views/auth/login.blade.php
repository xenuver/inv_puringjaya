<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Login - Rumah Makan Puring Jaya</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            /* Pastikan path gambar sesuai dengan lokasi file di folder public/images/ */
            background-image: url('{{ asset('assets/foto/background.jpeg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            /* Efek overlay agar background lebih gelap/hijau supaya teks terbaca */

            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card {

        }

        .text-primary { color: #009245 !important; }
        .btn-primary { background-color: #009245 !important; border-color: #009245 !important; }
        .btn-primary:hover { background-color: #007a3a !important; border-color: #007a3a !important; }
    </style>
</head>

<body>

    <div class="card shadow-lg border-0 rounded-4 p-4" style="max-width: 400px; width: 90%;">

        <h4 class="text-center fw-bold text-primary mb-0">Rumah Makan Puring Jaya</h4>
        <p class="text-center text-muted small mb-4">
            Silakan login untuk melanjutkan
        </p>

        <form action="{{ url('loginproses') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label small">Email</label>
                <input type="email" name="email" class="form-control form-control-lg" placeholder="Email" required>
            </div>

            <div class="mb-4">
                <label class="form-label small">Password</label>
                <input type="password" name="password" class="form-control form-control-lg" placeholder="••••••" required>
            </div>

            <button type="submit" class="btn btn-primary btn-lg w-100 fw-semibold">
                Login
            </button>
        </form>

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('success'))
        <script>
            Swal.fire({ icon: "success", title: "{{ session('success') }}", toast: true, position: "top-end", showConfirmButton: false, timer: 3000 });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({ icon: "error", title: "{{ session('error') }}", toast: true, position: "top-end", showConfirmButton: false, timer: 3000 });
        </script>
    @endif

</body>

</html>
