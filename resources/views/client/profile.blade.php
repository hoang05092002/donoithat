@extends('client.layout.main')

@section('title', 'Profile')

@section('content')
    <!-- Header -->

    <!-- Page content -->

    <div class="col-xl-9 order-xl-1 m-5">
        <div class="card card-profile shadow">
            <div class="card-header bg-white border-0">
                <div class="row align-items-center">
                    <div class="col-4">
                        <h3 class="mb-0">My account</h3>
                    </div>
                    <div class="col-4 mb-5">
                        <div class="card-profile-image">
                            <img width="400px" src="{{ asset(Auth::user()->avatar) }}" class="rounded-circle">
                        </div>
                    </div>
                    <div class="col-4 text-right">
                        <a href="{{route('users.trackOrder')}}" class="btn btn-sm btn-primary">Track Orders</a>
                    </div>
                </div>
            </div>
            <hr>
            <div class="card-body" style="background-color: #ffffff">
                <form action="{{ route('users.update', Auth::user()) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <h6 class="heading-small text-muted mb-4">User information</h6>
                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="input-username">Name</label>
                                    <input type="text" name="name" id="input-username"
                                        class="form-control form-control-alternative" placeholder="Username"
                                        value="{{ Auth::user()->name }}">
                                    <label for=""
                                        class="form-control-label text-danger">{{ $errors->first('name') }}</label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-email">Email
                                        address</label>
                                    <input type="text" name="email" id="input-email"
                                        class="form-control form-control-alternative" value="{{ Auth::user()->email }}">
                                    <label for=""
                                        class="form-control-label text-danger">{{ $errors->first('email') }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="my-4">
                    <!-- Address -->
                    <h6 class="heading-small text-muted mb-4">Contact information</h6>
                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="input-address">Address</label>
                                    <input id="input-address" name="address" class="form-control form-control-alternative"
                                        placeholder="Home Address" value="{{ Auth::user()->address }}" type="text">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="input-city">Number Phone</label>
                                    <input type="text" name="phone" id="input-city"
                                        class="form-control form-control-alternative" placeholder="City"
                                        value="{{ Auth::user()->phone }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="input-address">Avatar</label>
                                    <input id="input-address fileupload" name="avatar" class="form-control-file"
                                        placeholder="Home Address" type="file">
                                    <img width="100px" id="preview" src="" alt="">
                                    <label for=""
                                        class="form-control-label text-danger">{{ $errors->first('avatar') }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="my-4">
                    <!-- Description -->
                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="input-address">Password</label>
                                    <input id="input-address" name="password" class="form-control form-control-alternative"
                                        placeholder="" value="" type="password">
                                    <label for=""
                                        class="form-control-label text-danger">{{ $errors->first('password') }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="input-address">New Password</label>
                                    <input id="input-address" name="new_password" class="form-control form-control-alternative"
                                        placeholder="" value="" type="password">
                                    <label for=""
                                        class="form-control-label text-danger">{{ $errors->first('password') }}</label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="input-city">Confirm Password</label>
                                    <input type="password" name="confirm_password" id="input-city"
                                        class="form-control form-control-alternative" placeholder="" value="">
                                    <label for=""
                                        class="form-control-label text-danger">{{ $errors->first('comfirm_password') }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                            <div class="col-md-10">

                                <p class="alert-danger">
                                    {!! isset($error_pass) ? '<i class="ml-2 fa-solid fa-circle-exclamation"></i>' : '' !!}
                                    {{ isset($error_pass) ? $error_pass : '' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script></script>
@endsection
