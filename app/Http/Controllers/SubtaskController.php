<?php

namespace App\Http\Controllers;

use App\Models\Subtask;
use App\Models\User;
use App\Models\Task;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SubtaskController extends Controller
{
    public function index(Request $request)
    {
        $subtarefas = Subtask::with(['user','task'])->paginate(5);
        $request = $request->all();
        return view('app.subtasks.index', compact(['subtarefas','request']));
    }

    
    public function create()
    {
        $users = User::all();
        $tasks = auth()->user()->tasks()->get();

        return view('app.subtasks.create', compact(['tasks', 'users']));
    }

    public function store(Request $request)
    {
        $rules = [
            'task_id' => 'required|int|exists:tasks,id',
            'subtask_name' => 'required|min:5|max:255',
            'subtask_description' => 'required|min:5|max:255',
            'due_date' => 'required|date',
            'due_time' => 'required',
        ];

        $feedback = [
            'required' => 'É necessário preencher o :attribute',
            'max' => 'O :attribute pode ter no máximo :max caracteres',
            'min' => 'O :attribute precisa ter no mínimo :min caracteres',
            'int' => 'O :attribute preicsa',
            'exists' => 'A tarefa selecionada não foi encontrada'
        ];

        $request->validate($rules, $feedback);

        $dados = $request->only(['subtask_name','subtask_description','task_id','user_id']);
        
        if($request->due_date && $request->due_time){
            $dados['due_date'] = $request->due_date . ' ' . $request->due_time;
        }

        if($request->is_complete){
            $dados['is_complete'] = true;
        }

        if(Subtask::create($dados)){
            return redirect()->route('subtarefas.index');
        }else{
            return back()->with('error', 'Erro ao criar subtarefa');
        }
    }

    public function show(Subtask $subtarefa)
    {
        return view('app.subtasks.show', ['subtarefa' => $subtarefa]);
    }

    public function edit(Subtask $subtarefa)
    {
        $tasks = auth()->user()->tasks()->get();
        
        $users = User::all();
        $dueDateTime = Carbon::parse($subtarefa->due_date);
        $subtarefa->due_date = $dueDateTime->format('Y-m-d');
        $subtarefa->due_time = $dueDateTime->format('H:i');

        return view('app.subtasks.edit', compact(['users','subtarefa','tasks' ]));
    }

    public function update(Request $request, Subtask $subtarefa)
    {
        $rules = [
            'task_id' => 'required|int|exists:tasks,id',
            'subtask_name' => 'required|min:5|max:255',
            'subtask_description' => 'required|min:5|max:255',
            'due_date' => 'required|date',
            'due_time' => 'required',
        ];

        $feedback = [
            'required' => 'É necessário preencher o :attribute',
            'max' => 'O :attribute pode ter no máximo :max caracteres',
            'min' => 'O :attribute precisa ter no mínimo :min caracteres',
            'int' => 'O :attribute preicsa',
            'exists' => 'A tarefa selecionada não foi encontrada'
        ];

        $request->validate($rules, $feedback);

        $dados = $request->only(['subtask_name','subtask_description','task_id','user_id']);
        
        if($request->due_date && $request->due_time){
            $dados['due_date'] = $request->due_date . ' ' . $request->due_time;
        }

        if($request->is_complete){
            $dados['is_complete'] = true;
        }else{
            $dados['is_complete'] = false;
        }
        
        $subtarefa->update($dados);

        return redirect()->route('subtarefas.show', ['subtarefa' => $subtarefa->id]);
    }

    public function destroy(Subtask $subtarefa)
    {
        $subtarefa->delete();

        return redirect()->route('subtarefas.index');
    }
}
