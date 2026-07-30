<!DOCTYPE html>
<html lang="id">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login Admin</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>

        body{
            background:#eef5ef;
            font-family:'Segoe UI',sans-serif;
        }

        .login-card{

            width:420px;

            border:none;

            border-radius:20px;

            box-shadow:0 10px 25px rgba(0,0,0,.15);

        }

        .header{

            background:#2E7D32;

            color:white;

            text-align:center;

            padding:25px;

            border-radius:20px 20px 0 0;

        }

    </style>

</head>

<body>

<div class="container vh-100 d-flex justify-content-center align-items-center">

<div class="card login-card">

<div class="header">

<h3>🔒 Login Admin</h3>

<p class="mb-0">

Buku Tamu Digital Desa Tuwung

</p>

</div>

<div class="card-body p-4">

@if(session('error'))

<div class="alert alert-danger">

{{ session('error') }}

</div>

@endif

<form method="POST" action="/admin/login">

@csrf

<div class="mb-3">

<label class="form-label">

Email

</label>

<input

type="email"

name="email"

class="form-control"

required>

</div>

<div class="mb-4">

<label class="form-label">

Password

</label>

<input

type="password"

name="password"

class="form-control"

required>

</div>

<button

type="submit"

class="btn btn-success w-100">

Login

</button>

<br><br>

<a

href="/"

class="btn btn-secondary w-100">

Kembali

</a>

</form>

</div>

</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>