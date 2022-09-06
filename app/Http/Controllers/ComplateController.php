<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ComplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($user_id)
    {
        $todos = Todo::where([
            ['user_id', '=', $user_id],
            ['status', '=', 1],
        ])->get();
        return view('dashboard.complated_todo', compact('todos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $todo = Todo::where('id',$id)->update([
            'status'=>1,
            'done_time'=>Carbon::now('Asia/Jakarta')
        ]);
        if($todo){
            return redirect()->route('complated',Auth::user()->id)->with('complated', 'Kegiatan berhasil diubah statusnya menjadi selesai!');
        } else {
            return redirect()->route('complated',Auth::user()->id)->with('fail', 'Gagal mengubah status kegiatan menjadi selesai, coba lagi!');
        }
    }

    public function undo($id)
    {
        $todo = Todo::where('id',$id)->update([
            'status'=>0,
            'done_time'=>NULL,
        ]);
        if ($todo) {
            return redirect()->route('todo',Auth::user()->id)->with('undo', 'Kegiatan berhasil dikembalikan menjadi belum selesai!');
        } else {
            return redirect()->route('todo',Auth::user()->id)->with('fail', 'Gagal mengembalikan kegiatan, coba lagi!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Todo::where('id', $id)->delete();
        return redirect()->route('todo',Auth::user()->id)->with('success', 'berhasil menghapus data kegiatan yang telah selesai');
    }
}