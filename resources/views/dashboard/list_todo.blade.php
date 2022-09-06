@extends('layout')

@section('content')
<div class="container mt-3 mb-4">
    @if (Session::get('fail'))
    <div class="alert alert-danger">
        {{ Session::get('fail') }}
    </div>
    @endif
    @if (Session::get('success'))
    <div class="alert alert-success">
        {{ Session::get('success') }}
    </div>
    @endif
    @if (Session::get('undo'))
        <div class="alert alert-success">
            {{ Session::get('undo') }}
        </div>
    @endif
    <div class="wraper d-flex flex-wrap">
    @if ($todos->count() > 0)
    @foreach ($todos as $todo)
        <div class="todo">
            <div class="left-item">
                <h3>Belum Selesai Dikerjakan</h3>
                @if ($todo->date > $today)
                    <p>Target Selesai : {!! date('d/m/Y H:i', strtotime($todo->date)) !!}</p>
                @else
                    <p class="text-danger font-weight-bold">
                        Target Selesai : {!! date('d/m/Y H:i', strtotime($todo->date)) !!}
                        <br>Lewat Tenggat Waktu
                    </p>
                @endif
            </div>
            <div class="right-item">
                <h6>Daftar Kegiatan ke-{{$no++}}</h6>
                <h2>{{$todo->title}}</h2>
                <p>
                    {{$todo->description}}
                </p>
                <div class="action">
                    <a href="{{route('todo.edit',$todo->id)}}">
                        <img src="{{ asset('img/edit.svg') }}" alt="edit" width="20">
                    </a>
                    <a href="{{route('todo.complated',$todo->id)}}">
                        <img src="{{ asset('img/check-solid.svg') }}" alt="complated" width="20">
                    </a>
                    <form method="POST" action="{{route('todo.destroy',$todo->id)}}">
                        @csrf
                        @method('DELETE')
                        <input name="_method" type="hidden" value="DELETE">
                        <button type="submit" class="btn p-0 ml-2 show-alert-delete-box" data-toggle="tooltip" title='Delete' data-name="{{$todo->title}}">
                            <img src="{{ asset('img/trash-fill.svg') }}" alt="delete" width="20">
                        </button>
                    </form>
                    {{-- <a href="{{route('todo.destroy',$todo->id)}}" class="show-alert-delete-box" data-toggle="tooltip" title='Delete' data-name="{{$todo->title}}">
                        <img src="{{ asset('img/trash-fill.svg') }}" alt="delete" width="20">
                    </a> --}}
                </div>
            </div>
        </div>
    @endforeach
    </div>
    @else
    <div class="d-flex flex-column w-50 m-auto">
        <img src="{{ asset('img/not_found.svg') }}" alt="admin" width="300" class="d-block ml-auto mr-auto">
        <p class="h5 mt-3 text-center d-block ml-auto mr-auto">Data tidak ditemukan, kamu belum membuat daftar ToDo. Silahkan membuatnya terlebih dahulu.</p>
        <button type="button" class="btn btn-info d-block mr-auto ml-auto mt-3 btn-lg text-white" data-toggle="modal" data-target="#addTodo">Buat ToDo</button>
    </div>
    @include('dashboard.add_modal')
    @endif
</div>
@endsection