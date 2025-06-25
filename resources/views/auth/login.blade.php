<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Richz Web</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('template/mazer/dist/assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('template/mazer/dist/assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('template/mazer/dist/assets/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('template/mazer/dist/assets/css/pages/auth.css') }}">

    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background: linear-gradient(to right, #2A2B78, #5C6BC0);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }

        .login-card {
            background: white;
            padding: 3rem 2.5rem;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 450px;
        }

        .auth-logo img {
            max-height: 70px;
            margin-bottom: 1rem;
        }

        .auth-title {
            font-size: 2rem;
            font-weight: 700;
            color: #2A2B78;
            text-align: center;
        }

        .auth-subtitle {
            font-size: 1rem;
            text-align: center;
            color: #6c757d;
            margin-bottom: 2rem;
        }

        .form-control {
            border-radius: 10px;
            padding-left: 2.5rem;
        }

        .form-control-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
        }

        .btn-primary {
            background-color: #2A2B78;
            border-color: #2A2B78;
            border-radius: 10px;
        }

        .position-relative {
            position: relative;
        }
    </style>
</head>

<body>
    <div class="login-card">
        <div class="auth-logo text-center">
            <a href="/"><img src="{{ asset('logo/logo-icon.png') }}" alt="Richz Logo"></a>
        </div>
        <h1 class="auth-title">Welcome Back!</h1>
        <p class="auth-subtitle">Sign in to continue to Richz Web.</p>

        <form action="{{ url('/login') }}" method="POST">
            @csrf
            <div class="form-group position-relative has-icon-left mb-4">
                <input type="text" class="form-control form-control-xl" name="username" placeholder="Username">
                <div class="form-control-icon">
                    <i class="bi bi-person"></i>
                </div>
            </div>
            <div class="form-group position-relative has-icon-left mb-4">
                <input type="password" class="form-control form-control-xl" name="password" placeholder="Password">
                <div class="form-control-icon">
                    <i class="bi bi-shield-lock"></i>
                </div>
            </div>

            <button class="btn btn-primary btn-block btn-lg shadow-lg mt-3" type="submit">Log in</button>
        </form>
    </div>
</body>

</html>
