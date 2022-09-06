<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Todo;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($user_id)
    {
        $todos = Todo::where([
            ['user_id','=',$user_id],
            ['status','=',0],
        ])->get();
        $no = 1;
        $today = Carbon::now('Asia/Jakarta');
        return view('dashboard.list_todo', compact('todos', 'no', 'today'));
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
        $request->validate([
            'title' => 'required|min:4',
            'description' => 'required|min:15',
            'date' => 'required',
        ]);

        $todo = new Todo();
        $todo->user_id = $request->user_id;
        $todo->title = $request->title;
        $todo->description = $request->description;
        $todo->date = Carbon::parse($request->date);
        $todo->status = 0;
        $todo->save();

        if ($todo) {
            return redirect()->back()->with('success', 'Berhasil menambahkan kegiatan baru!');
        } else {
            return redirect()->back()->with('fail', 'Gagal membuat kegiatan, mohon dicoba lagi!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function show(Todo $todo)
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $todo = Todo::where('id',$id)->first();
        $todo->date = Carbon::parse($todo->date)->format('m/d/Y H:i A');
        $today = Carbon::now('Asia/Jakarta')->format('m/d/Y H:i A');
        return view('dashboard.edit_todo', compact('todo', 'today'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|min:4',
            'description' => 'required|min:15',
            'date' => 'required',
        ]);
        $todo = Todo::where('id',$id)->update([
            'title' => $request->title,
            'description' => $request->description,
            'date' => Carbon::parse($request->date),
        ]);
        if ($todo) {
            return redirect()->route('todo',Auth::user()->id)->with('success', 'Berhasil mengubah data kegiatan!');
        } else {
            return redirect()->route('todo',Auth::user()->id)->with('fail', 'Gagal mengubah kegiatan, mohon dicoba lagi!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Todo::where('id',$id)->delete();
        return redirect()->back()->with('success', 'berhasil menghapus data kegiatan');
    }
}