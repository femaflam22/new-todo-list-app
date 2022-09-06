@extends('layout')

@section('content')
<div class="container mt-3 mb-4">
    <h2 class="mt-4">Edit Kegiatan</h2>
    <div class="wraper d-flex flex-wrap">
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
                <h2>{{$todo->title}}</h2>
                <p>{{$todo->description}}</p>
            </div>
        </div>
        <form method="POST" action="{{route('todo.update',$todo->id)}}" class="form_edit">
            @method('PATCH')
            @csrf
            <div class="form-group">
                <label for="title" class="col-form-label">Nama Kegiatan:</label>
                <input type="text" class="form-control" id="title" name="title" value="{{$todo->title}}">
                <span class="text-danger mt-2">@error('title'){{ $message }}@enderror</span>
            </div>
            <div class="form-group">
                <label for="description" class="col-form-label">Deskripsi Kegiatan:</label>
                <textarea name="description" class="form-control" id="description" rows="2">{{$todo->description}}</textarea>
                <span class="text-danger mt-2">@error('description'){{ $message }}@enderror</span>
            </div>
            <div class="form-group">
                <label for="datetimepicker1" class="col-form-label">Target Selesai:</label>
                <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                    <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker1" name="date" value="{{$todo->date}}"/>
                    <span class="input-group-addon" data-target="#datetimepicker1" data-toggle="datetimepicker">
                        <span class="fa fa-calendar"></span>
                    </span>
                </div>
                <span class="text-danger mt-2">@error('date'){{ $message }}@enderror</span>
            </div>
            <a type="button" class="btn btn-secondary" href="{{route('todo',Auth::user()->id)}}">Kembali</a>
            <button type="submit" class="btn btn-primary">Ubah</button>           
        </form>
    </div>
</div>
@endsection