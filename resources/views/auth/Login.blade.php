<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>GFI ERP</title>
    <link rel="stylesheet" href="{{ asset('Assets/css/basedStayle.css') }}">
    <link rel="stylesheet" href="{{ asset('Assets/css/popupStayle.css') }}">
    {{--  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">  --}}

</head>
<body>
    <div class="container">
        @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">X</button>
        </div>
        @endif
        @if (session()->has('error'))
        <div class="alert alert-error alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">X</button>
        </div>
        @endif

        <div class="header-logo">
            <div class="logo">
                <img src="{{ asset('Assets/image/Logo1.png') }}" alt="" srcset="">
            </div>
            <div class="logo">
                <img src="{{ asset('Assets/image/gfi.png') }}" alt="" srcset="">
            </div>

        </div>
        <div class="login-layoute">

            <div class="card">

                <div class="form-auth">

                    <h2 class="header-form">GFI ERP Login</h2>
                    <form action="{{ route('loginadmin') }}" method="post">
                        @csrf
                        <div class="input">
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" required>
                            <label>Email (email@exampel.com)</label>
                            @error('email')
                            <small class="text-danger">{{ $message }}</small>
                             @enderror
                        </div>
                        <div class="input">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                            <label>Your Password</label>
                            @error('password')
                            <small class="text-danger">{{ $message }}</small>
                             @enderror
                        </div>
                        <div class="button">
                            <button type="submit" class="button-auth">Sign in</button>
                            <span class="notes">you dont have an account yet?</span><span class="notes-link"><a href="#">Registration Now</a></span>
                        </div>
                    </form>


                </div>
            </div>
            <div class="card">
                <div class="ilustrasi-image">
                    <img src="{{ asset('Assets/image/FG2.png') }}" alt="" srcset="">
                </div>
            </div>
        </div>
    </div>

    //<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>
