<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Stay Ease - Login</title>
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>
<!-- ... (head section remains the same) ... -->
<body class="bg-gradient-primary">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-8 col-md-10">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-5">
                        <div class="text-center mb-4">
                            <h1 class="h4 text-gray-900">Selamat Datang !</h1>
                        </div>
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if($errors->any())
                            @foreach($errors->all() as $err)
                                <div class="alert alert-danger">{{ $err }}</div>
                            @endforeach
                        @endif
                        <form action="{{ route('login.action') }}" class="user" method="post">
                            @csrf {{-- Include the CSRF token --}}
                            
                            <div class="form-group">
                                <input type="text" name="username" value="{{ old('username') }}" class="form-control form-control-user" placeholder="Enter Username...">
                            </div>

                            <div class="form-group">
                                <input type="password" name="password" class="form-control form-control-user" placeholder="Password...">
                            </div>

                            <button type="submit" class="btn btn-primary btn-user btn-block">Login</button>
                        </form>
                        <hr>
                        {{-- Additional content (e.g., create an account link) --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ... (existing script tags) ... -->
</body>
</html>
