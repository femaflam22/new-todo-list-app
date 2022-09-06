<div class="modal fade" id="addTodo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Kegiatan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info" role="alert">
                Jika setelah <strong>klik Tambahkan</strong> kamu <strong>tidak mendapatkan pemberitahuan apapun</strong> di halaman <strong>beranda, diatas gambar</strong>. Silahkan klik button <strong>"Buat Kegiatan"</strong> kembali!
                </div>
                <form method="POST" action="{{route('newTodo')}}">
                @csrf
                    <div class="form-group">
                        <input type="text" class="form-control" id="user_id" name="user_id" value="{{Auth::user()->id}}" hidden>
                    </div>
                    <div class="form-group">
                        <label for="title" class="col-form-label">Nama Kegiatan:</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{old('title')}}">
                        <span class="text-danger mt-2">@error('title'){{ $message }}@enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="description" class="col-form-label">Deskripsi Kegiatan:</label>
                        <textarea name="description" class="form-control" id="description" rows="2">{{old('description')}}</textarea>
                        <small class="text-secondary">Minimal 15 karakter</small>
                        <span class="text-danger mt-2">@error('description'){{ $message }}@enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="datetimepicker1" class="col-form-label">Target Selesai:</label>
                        <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker1" name="date" value="{{old('date')}}" />
                            <span class="input-group-addon" data-target="#datetimepicker1" data-toggle="datetimepicker">
                                <span class="fa fa-calendar"></span>
                            </span>
                        </div>
                        <span class="text-danger mt-2">@error('date'){{ $message }}@enderror</span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-primary">Tambahkan</button>
                </div>
            </form>
        </div>
    </div>
</div>