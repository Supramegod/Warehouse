@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- CSS Custom langsung di sini -->
    <style>
      .divider:after,
      .divider:before {
        content: "";
        flex: 1;
        height: 1px;
        background: #eee;
      }
      .h-custom {
        height: calc(100% - 73px);
      }
      @media (max-width: 450px) {
        .h-custom {
          height: 100%;
        }
      }
    </style>
</head>
<body>

<section class="vh-100"> 
  <div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-7 col-lg-6 col-xl-5">
        <img src="{{ asset('assets/img/warehouse.jpg') }}" class="img-fluid" alt="Warehouse image">
      </div>
      <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">

        @if (session('success'))
          <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
          <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}">
          @csrf

          @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              {{ session('error') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @endif

          <!-- Email or Username input -->
            <div class="form-outline mb-4">
              <label class="form-label" for="form3Example3">Email atau Username</label>
              <input type="text" name="login" id="form3Example3" class="form-control form-control-lg" placeholder="Masukkan email atau username" value="{{ old('login') }}" required />
            </div>


          <!-- Password input -->
          <div class="form-outline mb-3">
            <label class="form-label" for="form3Example4">Password</label>
            <input type="password" name="password" id="form3Example4" class="form-control form-control-lg" placeholder="Enter password" required />
          </div>

          <div class="d-flex justify-content-between align-items-center">
            <div class="form-check mb-0">
              <input class="form-check-input me-2" type="checkbox" name="remember" id="form2Example3" />
              <label class="form-check-label" for="form2Example3">
                Remember me
              </label>
            </div>
          </div>

          <div class="text-center text-lg-start mt-4 pt-2">
            <button type="submit" class="btn btn-primary btn-lg px-5">Login</button>
            <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account?
              <a href="{{ route('register') }}" class="link-danger">Register</a>
            </p>
          </div>
        </form>

      </div>
    </div>
  </div>

  <div class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-primary">
    <div class="text-white mb-3 mb-md-0">
      Copyright © 2025. All rights reserved.
    </div>
  </div>
</section>

</body>
</html>
@endsection
