<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use App\Http\Requests\TodoRequest;
use App\Models\Category;

class TodoController extends Controller
{
    //一覧表示
    public function index()
    {
        $todos = Todo::with('category')->get();
        $categories = Category::all();
        return view('index', compact('todos', 'categories'));
    }
    //追加処理
    public function store(TodoRequest $request)
    {
        $todo =$request->only(['category_id','content']);
        Todo::create($todo);
        return redirect('/')->with('success', 'Todoを作成しました');
    }

    //更新処理
    public function update(TodoRequest $request)
    {
        $todo= $request->only(['content']);
        Todo::find($request->id)->update($todo);
        return redirect('/')->with('success', 'Todoを更新しました');
    }
    //削除処理
    public function destroy(Request $request)
    {
        $todo = Todo::find($request->id)->delete();
        return redirect('/')->with('success', 'Todoを削除しました');
    }
    //検索処理
    public function search(Request $request)
    {
        $todos = Todo::with('category')
            ->categorySearch($request->category_id)
            ->keywordSearch($request->keyword)
            ->get();
        $categories = Category::all();
        return view('index', compact('todos','categories'));
}
}