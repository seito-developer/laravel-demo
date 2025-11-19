<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTodoRequest;
use App\Models\Project;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        // ユーザーに紐づくプロジェクトと、各プロジェクトに紐づくタスクを「Eager Loading」で取得
        // N+1問題を回避するため、 with() を使う
        $projects = $user->projects()->with('todos')->get();
        
        // (タスク作成時に「プロジェクト」を選ばせるため、プロジェクト一覧も渡す)
        $allProjects = $user->projects;

        return view('todos.index', [
            'projectsWithTodos' => $projects,
            'projectsForForm' => $allProjects,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTodoRequest $request)
    {
        // --- ここに到達した時点で、バリデーションは「通過」している ---

        // バリデーション済みのデータを取得
        $validated = $request->validated();
        
        // (CH4への布石)
        // このプロジェクトIDが、本当にログインユーザーのものか、本当はチェックが必要！
        $project = Project::findOrFail($validated['project_id']);
        if ($project->user_id !== Auth::id()) {
            abort(403, '不正な操作です。'); // 403 Forbidden
        }

        // リレーションを使ってタスクを作成（project_id は自動で入る）
        $project->todos()->create([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null, // nullableなので ?? null
        ]);

        // 元のページ (タスク一覧) にリダイレクト
        return redirect()->route('dashboard');
    }


    /**
     * Display the specified resource.
     */
    public function show(Todo $todo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Todo $todo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Todo $todo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo)
    {
        //
    }
}
