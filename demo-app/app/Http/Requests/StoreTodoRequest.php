<?php

namespace App\Http\Requests;

use App\Models\Project;
use Illuminate\Foundation\Http\FormRequest;

class StoreTodoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // 送信されてきた 'project_id' からプロジェクトを取得
        $project = Project::find($this->input('project_id'));

        // プロジェクトが存在し、かつ、
        // ログインユーザーが、そのプロジェクトを 'update' できるか？ (ProjectPolicy@update が呼ばれる)
        return $project && $this->user()->can('update', $project);

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // 'title' は...
            'title' => 'required|string|max:255', // 必須(required)で、文字列(string)で、255文字まで(max)
            
            // 'project_id' は...
            'project_id' => 'required|integer|exists:projects,id', // 必須(required)で、整数(integer)で、
                                                                 // projectsテーブルのidカラムに実在する(exists)こと
                                                                 
            // 'description' は...
            'description' => 'nullable|string', // nullでもOK(nullable)だが、送るなら文字列(string)であること
        ];
    }
}
