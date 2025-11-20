<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTodoRequest;
use App\Models\Project;
use App\Models\Todo;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\JsonResponse;

class TodoController extends Controller
{
    use AuthorizesRequests;
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
    public function update(StoreTodoRequest $request, Todo $todo)
    {
        // 認可チェック: ログインユーザーは、この $todo を 'update' できるか？
        // (TodoPolicy@update が呼ばれる)
        $this->authorize('update', $todo); 

        // --- 認可OK ---
        
        $validated = $request->validated(); // (Update用のRequestも別途定義するのが望ましい)
        $todo->update($validated);
        
        return redirect()->route('home');
    }

    public function destroy(Todo $todo)
    {
        // 認可チェック: ログインユーザーは、この $todo を 'delete' できるか？
        // (TodoPolicy@delete が呼ばれる)
        $this->authorize('delete', $todo);

        // --- 認可OK ---
        
        $todo->delete();
        
        return redirect()->route('home');
    }

    public function toggle(Todo $todo): JsonResponse
    {
        // 認可は絶対に忘れない！ (update権限で代用)
        $this->authorize('update', $todo);
        
        // is_completed を反転させる (true -> false, false -> true)
        $todo->is_completed = !$todo->is_completed;
        $todo->save();
        
        // JS側に、成功したことと新しい状態を JSON で返す
        return response()->json([
            'status' => 'success',
            'is_completed' => $todo->is_completed,
        ]);
    }

}
