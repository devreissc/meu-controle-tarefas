<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TaskController extends Controller
{

    public function index(Request $request)
    {
        // $tasks = Task::where('user_id', auth()->id())->get();
        $tasks = Task::with('user')->withCount('subtasks')->paginate(5); // Busca todas as tarefas do usuário autenticado, usando o relacionamento definido no modelo User
        $request = $request->all();
        return view('app.tasks.index', compact(['tasks','request']));
    }


    public function create()
    {
        $users = User::all();
        $projects = Project::all();

        return view('app.tasks.create', compact(['projects', 'users']));
    }

    public function store(Request $request)
    {
        $rules = [
            'task_name' => 'required|min:3|max:255',
            'task_description' => 'required|min:3|max:255',
            'due_date' => 'required|date',
            'due_time' => 'required',
            'project_id' => 'required'
        ];

        $feedback = [
            'required' => 'O campo :attribute é obrigatório',
            'min' => 'O campo :attribute deve ter no mínimo :min caracteres',
            'max' => 'O campo :attribute deve ter no máximo :max caracteres',
            'date' => 'O campo :attribute deve ser uma data válida',
        ];

        $request->validate($rules, $feedback);

        $dados = $request->only(['task_name','task_description','project_id','user_id']);
        
        if($request->due_date && $request->due_time){
            $dados['due_date'] = $request->due_date . ' ' . $request->due_time;
        }

        if($request->is_complete){
            $dados['is_complete'] = true;
        }

        if(Task::create($dados)){
            return redirect()->route('tarefas.index');
        }else{
            return back()->with('error', 'Erro ao criar tarefa');
        }
    }

    public function show(Task $tarefa)
    {
        return view('app.tasks.show', ['tarefa' => $tarefa]);
    }

    public function edit(Task $tarefa)
    {
        $projects = Project::all();
        
        $users = User::all();
        
        $dueDateTime = Carbon::parse($tarefa->due_date);
        $tarefa->due_date = $dueDateTime->format('Y-m-d');
        $tarefa->due_time = $dueDateTime->format('H:i');

        return view('app.tasks.edit', compact(['projects','tarefa','users']));
    }

    public function update(Request $request, Task $tarefa)
    {
        $rules = [
            'task_name' => 'required|min:3|max:255',
            'task_description' => 'required|min:3|max:255',
            'due_date' => 'required|date',
            'due_time' => 'required',
            'project_id' => 'required'
        ];

        $feedback = [
            'required' => 'O campo :attribute é obrigatório',
            'min' => 'O campo :attribute deve ter no mínimo :min caracteres',
            'max' => 'O campo :attribute deve ter no máximo :max caracteres',
            'date' => 'O campo :attribute deve ser uma data válida',
        ];

        $request->validate($rules, $feedback);

        $dados = $request->only(['task_name','task_description','project_id','user_id']);
        
        if($request->due_date && $request->due_time){
            $dados['due_date'] = $request->due_date . ' ' . $request->due_time;
        }

        if($request->is_complete){
            $dados['is_complete'] = true;
        }else{
            $dados['is_complete'] = false;
        }
        // dd($dados);
        $tarefa->update($dados);

        return redirect()->route('tarefas.show', ['tarefa' => $tarefa->id]);
    }

    public function destroy(Task $tarefa)
    {
        $tarefa->delete();

        return redirect()->route('tarefas.index');
    }
}
