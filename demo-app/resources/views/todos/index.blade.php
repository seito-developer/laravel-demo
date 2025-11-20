@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div style="margin-bottom: 20px;">
        <a href="{{ route('projects.create') }}">＋ 新しいプロジェクトを作る</a>
    </div>
    
    <h2>タスク作成</h2>
    <h2>タスク一覧</h2>
    @foreach ($projectsWithTodos as $project)
        <h3>{{ $project->name }} ({{ $project->todos->count() }}件)</h3>
        <ul>
            @foreach ($project->todos as $todo)
                <li>
                    {{ $todo->title }}
                    ( {{ $todo->is_completed ? '完了' : '未完了' }} )
                    </li>
            @endforeach
        </ul>
    @endforeach

    @if ($errors->any())
        <div class="errors">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('todos.store') }}">
        @csrf
        <div>
            <label for="project_id">プロジェクト:</label>
            <select name="project_id" id="project_id">
                <option value="">選択してください</option>
                @foreach ($projectsForForm as $project)
                    <option value="{{ $project->id }}" @selected(old('project_id') == $project->id)>
                        {{ $project->name }}
                    </option>
                @endforeach
            </select>
            @error('project_id') <span class="error">{{ $message }}</span> @enderror
        </div>
        
        <div>
            <label for="title">タスク名:</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}">
            @error('title') <span class="error">{{ $message }}</span> @enderror
        </div>
        
        <div>
            <label for="description">詳細:</label>
            <textarea name="description" id="description">{{ old('description') }}</textarea>
            @error('description') <span class="error">{{ $message }}</span> @enderror
        </div>
        
        <button type="submit">タスクを追加</button>
    </form>

    @push('scripts')
        @vite('resources/js/todo.js')
    @endpush

@endsection