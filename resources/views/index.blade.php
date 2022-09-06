<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo Apps</title>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div class="wrap">
        <div class="forms-container">
            <div class="add-check">
                <form class="sign-in" action="{{route('check')}}" method="POST">
                    @if (Session::get('fail'))
                    <div class="alert alert-danger w-75">
                        {{ Session::get('fail') }}
                    </div>
                    @endif
                    @if (Session::get('success'))
                        <div class="alert alert-success w-75">
                            {{ Session::get('success') }}
                        </div>
                    @endif
                    @csrf
                    <h2 class="title">Sign In</h2>
                    <div class="input-field">
                        <img src="{{ asset('img/username.svg') }}" alt="">
                        <input type="text" id="username" name="username" placeholder="Masukkan username anda">
                    </div>
                    <span class="text-danger mt-2">@error('username'){{ $message }}@enderror</span>
                    <div class="input-field">
                        <img src="{{ asset('img/password.svg') }}" alt="">
                        <input type="password" id="password" name="password" placeholder="Masukkan password anda">
                    </div>
                    <span class="text-danger mt-2">@error('password'){{ $message }}@enderror</span>
                    <button type="submit" class="btn-submit" id="sign-in_check">Sign-in</button>
                </form>

                <form class="sign-up" action="{{route('register')}}" method="POST">
                    <div class="alert alert-info w-75" role="alert">
                    Jika setelah <strong>klik Sign-Up</strong> kamu <strong>tidak mendapatkan pemberitahuan apapun</strong> di bagian <strong>atas tulisan "Sign-In"</strong>. Silahkan klik button <strong>"Buat Akun"</strong> kembali!
                    </div>
                    @csrf
                    <h2 class="title">Sign-up</h2>
                    <div class="input-field">
                        <img src="{{ asset('img/name.svg') }}" alt="">
                        <input type="text" id="name" name="name" placeholder="Masukkan nama lengkap">
                    </div>
                    <span class="text-danger mt-2">@error('name'){{ $message }}@enderror</span>
                    <div class="input-field">
                        <img src="{{ asset('img/email.png') }}" alt="">
                        <input type="email" id="email" name="email" placeholder="Masukkan alamat email">
                    </div>
                    <span class="text-danger mt-2">@error('email'){{ $message }}@enderror</span>
                    <div class="input-field">
                        <img src="{{ asset('img/username.svg') }}" alt="">
                        <input type="text" id="username" name="username" placeholder="Masukkan username">
                    </div>
                    <small class="text-secondary">Minimal 4 karakter</small>
                    <span class="text-danger mt-2">@error('username'){{ $message }}@enderror</span>
                    <div class="input-field">
                        <img src="{{ asset('img/password.svg') }}" alt="">
                        <input type="password" id="password" name="password" placeholder="Masukkan password">
                    </div>
                    <small class="text-secondary">Minimal 8 karakter</small>
                    <span class="text-danger mt-2">@error('password'){{ $message }}@enderror</span>
                    <button type="submit" class="btn-submit" id="sign-up_check">Sign-up</button>
                </form>
            </div>
        </div>

        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>Your ToDo List</h3>
                    <p>Buat daftar kegiatan yang harus kamu lakukan. Kemudian kelompokkan daftar kegiatan yang sudah selesai dikerjakan dan belum dikerjakan.</p>
                    <button class="btn transparent" id="signUp-btn">Buat Akun</button>
                </div>

                <img src="{{ asset('img/todo.png') }}" class="image" alt="">
            </div>

            <div class="panel right-panel">
                <div class="content">
                    <h3>Your ToDo List</h3>
                    <p>Buat daftar kegiatan yang harus kamu lakukan. Kemudian kelompokkan daftar kegiatan yang sudah selesai dikerjakan dan belum dikerjakan.</p>
                    <button class="btn transparent" id="signIn-btn">Login</button>
                </div>

                <img src="{{ asset('img/complated.png') }}" class="image" alt="">
            </div>
        </div>
    </div>

    <script src="{{ asset('js/script.js') }}" type="text/javascript"></script>
</body>

</html>