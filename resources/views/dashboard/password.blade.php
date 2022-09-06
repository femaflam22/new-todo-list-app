@extends('layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">UBAH PASSWORD</div>
                <div class="card-body">
                    <form method="POST" action="{{route('password.changed')}}">
                        @if (Session::get('success'))
                            <div class="alert alert-success">
                                {{ Session::get('success') }}
                            </div>
                        @endif
                        @if (Session::get('fail'))
                            <div class="alert alert-danger">
                                {{ Session::get('fail') }}
                            </div>
                        @endif
                        @csrf
                        @method('PATCH')
                        <div class="form-group row">
                            <label for="old_password" class="col-md-4 col-form-label text-md-right">Password Kini</label>

                            <div class="col-md-6">
                                <input id="old_password" type="password" class="form-control" name="old_password" value="{{old('old_password')}}">
                                <span class="text-danger mt-2">@error('old_password'){{ $message }}@enderror</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Password Baru</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password">
                                <span class="text-danger mt-2">@error('password'){{ $message }}@enderror</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="confirm_password" class="col-md-4 col-form-label text-md-right">Konfirmasi Password Baru</label>
                            <div class="col-md-6">
                                <input id="confirm_password" type="password" class="form-control" name="password_confirmation">
                                <span class="text-danger mt-2">@error('confirm_password'){{ $message }}@enderror</span>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">Ubah Password</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection