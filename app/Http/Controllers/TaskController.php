<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{

    public function index()
    {
        // $tasks = Task::where('user_id', auth()->id())->get();
        $tasks = auth()->user()->tasks; // Busca todas as tarefas do usuário autenticado, usando o relacionamento definido no modelo User

        return view('app.tasks.index', compact('tasks'));
    }


    public function create()
    {
        return view('app.tasks.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'task_name' => 'required|min:3|max:255',
            'task_description' => 'required|min:3|max:255',
            'due_date' => 'required|date',
            'due_time' => 'required',
        ];

        $feedback = [
            'required' => 'O campo :attribute é obrigatório',
            'min' => 'O campo :attribute deve ter no mínimo :min caracteres',
            'max' => 'O campo :attribute deve ter no máximo :max caracteres',
            'date' => 'O campo :attribute deve ser uma data válida',
        ];

        $request->validate($rules, $feedback);

        $dados = $request->only(['task_name','task_description']);

        if($request->due_date && $request->due_time){
            $dados['due_date'] = $request->due_date . ' ' . $request->due_time;
        }

        if($request->is_complete){
            $dados['is_complete'] = true;
        }

        $dados['user_id'] = Auth::id();
        // dd($dados);
        if(Task::create($dados)){
            return redirect()->route('tarefas.index');
        }else{
            return back()->with('error', 'Erro ao criar tarefa');
        }
    }

    public function show(Task $task)
    {
    }

    public function edit(Task $task)
    {
    }

    public function update(Request $request, Task $task)
    {
    }

    public function destroy(Task $task)
    {
    }
}
