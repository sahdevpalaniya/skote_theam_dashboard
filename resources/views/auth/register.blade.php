@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-7">
            <div class="text-primary p-4">
                <h5 class="text-primary">Free Register</h5>
                <p>Get your free Skote account now.</p>
            </div>
        </div>
        <div class="col-5 align-self-end">
            <img src="assets/images/profile-img.png" alt="" class="img-fluid">
        </div>
    </div>
    </div>
    <div class="card-body pt-0">
        <div>
            <a href="">
                <div class="avatar-md profile-user-wid mb-4">
                    <span class="avatar-title rounded-circle bg-light">
                        <img src="assets/images/logo.svg" alt="" class="rounded-circle" height="34">
                    </span>
                </div>
            </a>
        </div>
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-3">
                <label for="useremail" class="form-label">Name</label>
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                    value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Enter Name">

                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="username" class="form-label">Email</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                    name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Enter Email Address">

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="userpassword" class="form-label">Password</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    name="password" required autocomplete="new-password" placeholder="Enter Password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="userpassword" class="form-label">Confirm Password</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                    required autocomplete="new-password" placeholder="Confirm Password">
            </div>

            <div class="mt-4 d-grid">
                <button class="btn btn-primary waves-effect waves-light" type="submit">Register</button>
            </div>

            <div class="mt-4 text-center">
                <h5 class="font-size-14 mb-3">Sign up using</h5>

                <ul class="list-inline">
                    <li class="list-inline-item">
                        <a href="javascript::void()" class="social-list-item bg-primary text-white border-primary">
                            <i class="mdi mdi-facebook"></i>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="javascript::void()" class="social-list-item bg-info text-white border-info">
                            <i class="mdi mdi-twitter"></i>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="javascript::void()" class="social-list-item bg-danger text-white border-danger">
                            <i class="mdi mdi-google"></i>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="mt-4 text-center">
                <p class="mb-0">By registering you agree to the Skote <a href="#"
                        class="text-primary">Terms
                        of Use</a></p>
            </div>
        </form>
    </div>

    </div>
    </div>
    <div class="mt-5 text-center">

        <div>
            <p>Already have an account ? <a href="{{ route('login') }}" class="fw-medium text-primary"> Login</a> </p>
            <p>©
                <script>
                    document.write(new Date().getFullYear())
                </script> Skote. Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesbrand
            </p>
        </div>
    </div>
@endsection
