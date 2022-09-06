@extends('layout')

@section('content')
<div class="container">
    @if (Session::get('fail'))
    <div class="alert alert-danger">
        {{ Session::get('fail') }}
    </div>
    @endif
    @if (Session::get('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }} <a href="{{route('todo',Auth::user()->id)}}" class="alert-link">lihat disini</a>
        </div>
    @endif
    <img src="{{ asset('img/list.svg') }}" alt="admin" width="300" class="d-block ml-auto mr-auto mt-5">
    <p class="h5 mt-3 w-75 text-center d-block ml-auto mr-auto">Silahkan pilih di bagian atas ( breadcrumb ) untuk melihat daftar ToDo-mu, atau klik button dibawah untuk menambahkan ToDo</p>
    <button type="button" class="btn btn-info d-block mr-auto ml-auto mt-3 btn-lg text-white" data-toggle="modal" data-target="#addTodo">Buat ToDo</button>
    @include('dashboard.add_modal')
</div>
@endsection