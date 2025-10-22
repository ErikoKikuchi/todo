<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use App\Http\Requests\TodoRequest;

class TodoController extends Controller
{
    //一覧表示
    public function index()
    {
        $todos = Todo::all();
        return view('index', compact('todos'));
    }
    //追加処理
    public function store(TodoRequest $request)
    {   
        $todo =$request->only(['content']);
        Todo::create($todo);
        return redirect('/')->with('success', 'Todoを作成しました');
    }

    //更新処理
    public function update(TodoRequest $request)
    {
        $todo = Todo::find($request->id);
        $todo->content = $request->content;
        $todo->save();
        return redirect('/')->with('success', 'Todoを更新しました');
    }
    //削除処理
    public function destroy(Request $request)
    {
        $todo = Todo::find($request->id)->delete();
        return redirect('/')->with('success', 'Todoを削除しました');
    }
}
