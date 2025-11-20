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
        <ul class="flex flex-col gap-4 max-w-md">
            @foreach ($project->todos as $todo)
                <li class="bg-neutral-primary-soft block p-4 border border-default rounded-base shadow-xs">
                    {{ $todo->title }}
                    ( {{ $todo->is_completed ? '完了' : '未完了' }} )
                    <div class="ms-2.5 text-sm border-s border-default ps-3.5">
                        {{ $todo->description }}
                    </div>
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

    <div class="bg-neutral-primary-soft block max-w-sm p-6 border border-default rounded-base shadow-xs">
        <form class="flex flex-col gap-2" method="POST" action="{{ route('todos.store') }}">
            @csrf
            <div>
                <label for="project_id" class="block mb-2.5 text-lg font-medium text-heading">プロジェクト:</label>
                <select name="project_id" id="project_id" class="block w-full px-3 py-2.5 bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand shadow-xs placeholder:text-body">
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
                <label for="title" class="block mb-2.5 text-lg font-medium text-heading">タスク名:</label>
                <input type="text" name="title" id="title" class="bg-neutral-secondary-medium border border-default-medium text-heading text-base rounded-base focus:ring-brand focus:border-brand block w-full px-3.5 py-3 shadow-xs placeholder:text-body" value="{{ old('title') }}" />
                @error('title') 
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            
            <div>
                <label for="description" class="block mb-2.5 text-lg font-medium text-heading">詳細:</label>
                <textarea name="description" id="description" rows="4" class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full p-3.5 shadow-xs placeholder:text-body" placeholder="Write your thoughts here...">{{ old('description') }}</textarea>
                @error('description') <span class="error">{{ $message }}</span> @enderror
            </div>
            
            <button type="submit" class="text-white bg-brand box-border border border-transparent hover:bg-brand-strong focus:ring-4 focus:ring-brand-medium shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none">タスクを追加</button>
        </form>
    </div>

    @push('scripts')
        @vite('resources/js/todo.js')
    @endpush

@endsection