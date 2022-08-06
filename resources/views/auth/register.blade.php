@extends('auth.main')

@section('title', 'Register')

@section('content')
    <div>
    </div>
    <section class="vh-100 mt-2">
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-6 col-lg-12 col-xl-5">
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
                        class="img-fluid" alt="Sample image">
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                    <form action="{{ route('register.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
                            <p class="lead fw-normal mb-0 me-3">Register in with</p>
                            <button type="button" class="btn btn-primary btn-floating mx-1">
                                <i class="fab fa-facebook-f"></i>
                            </button>

                            <button type="button" class="btn btn-primary btn-floating mx-1">
                                <i class="fab fa-twitter"></i>
                            </button>

                            <button type="button" class="btn btn-primary btn-floating mx-1">
                                <i class="fab fa-linkedin-in"></i>
                            </button>
                        </div>

                        <div class="divider d-flex align-items-center my-4">
                            <p class="text-center fw-bold mx-3 mb-0">Or</p>
                        </div>

                        <div class="form-outline mb-4">
                            <label class="form-label" for="form3Example3">Name</label>
                            <input type="text" name="name" id="form3Example3" class="form-control form-control-lg"
                                placeholder="" value="{{ old('name') }}" />
                            <label for=""
                                class="form-label text-danger">{{ $errors->first('name') ? $errors->first('name') : '' }}</label>
                        </div>
                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <label class="form-label" for="form3Example3">Email address</label>
                            <input type="text" name="email" id="form3Example3" class="form-control form-control-lg"
                                placeholder="Enter a valid email address" value="{{ old('email') }}" />

                            <label class="text-danger">{{ $errors->first('email') ? $errors->first('email') : '' }}</label>
                        </div>

                        <!-- Password input -->
                        <div class="form-outline mb-3">
                            <label class="form-label" for="form3Example4">Password</label>
                            <input type="password" name="password" id="form3Example4" class="form-control form-control-lg"
                                placeholder="Enter password" />
                            <label
                                class="text-danger form-label">{{ $errors->first('password') ? $errors->first('password') : '' }}</label>
                        </div>

                        <div class="form-outline mb-3">
                            <label class="form-label" for="form3Example4">Comfirm Password</label>
                            <input type="password" name="confirm_password" id="form3Example4"
                                class="form-control form-control-lg" placeholder="Enter password" />
                            <label
                                for="form-label text-danger">{{ $errors->first('comfirm_password') ? $errors->first('confirm_password') : '' }}</label>
                        </div>

                        <div class="form-outline mb-4">
                            <label class="form-label" for="form3Example3">Avatar</label>
                            <input type="file" name="avatar" id="form3Example3"
                                class="form-control-file form-control-lg" placeholder="" />
                            <label for=""
                                class="form-label text-danger">{{ $errors->first('avatar') ? $errors->first('avatar') : '' }}</label>

                        </div>

                        <div class="form-outline mb-4">
                            <label class="form-label" for="form3Example3">Phone number</label>
                            <input type="text" name="phone" id="form3Example3" class="form-control form-control-lg"
                                placeholder="" value="{{old('phone')}}"/>
                            <label for=""
                                class="form-label text-danger">{{ $errors->first('phone') ? $errors->first('phone') : '' }}</label>

                        </div>

                        <div class="form-outline mb-4">
                            <label class="form-label" for="form3Example3">Address</label>
                            <input type="text" name="address" id="form3Example3" class="form-control form-control-lg"
                                placeholder="   " value="{{old('address')}}"/>
                            <label for=""
                                class="form-label text-danger">{{ $errors->first('address') ? $errors->first('address') : '' }}</label>

                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <!-- Checkbox -->
                            <div class="form-check mb-0">
                                <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3" />
                                <label class="form-check-label" for="form2Example3">
                                    Remember me
                                </label>
                            </div>
                            <a href="#!" class="text-body">Forgot password?</a>
                        </div>

                        <div class="text-center text-lg-start mt-4 pt-2">
                            <button type="submit" class="btn btn-primary btn-lg"
                                style="padding-left: 2.5rem; padding-right: 2.5rem;">Create</button>
                            <p class="small fw-bold mt-2 pt-1 mb-0">Have an account? <a href="{{ route('sign-in') }}"
                                    class="link-danger">Sign in</a></p>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
