<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = auth()->user()->projects()->with('user')->withCount('tasks')->get();
        
        return view('app.projects.index', compact('projects'));
    }

    public function create()
    {
        $users = User::all();
        return view('app.projects.create', compact('users'));
    }

    public function store(Request $request)
    {
        $rules = [
            'project_name' => 'required|min:5|max:255',
            'project_description' => 'required|min:5|max:255',
            'due_date' => 'date',
        ];

        $feedback = [
            'required' => 'O campo :attribute é obrigatório',
            'min' => 'O campo :attribute precisa ter no mínimo :min caracteres',
            'max' => 'O campo :attribute pode ter no máximo :max caracteres',
            'date' => 'O campo :attribute está preenchido incorretamente',
            'time' => 'O campo :attribute está preenchido incorretamente',
        ];

        $request->validate($rules, $feedback);

        $dados = $request->only(['project_name','project_description','user_id']);
        $dados['user_id'] = Auth::id();

        if ($request->filled('due_date') && $request->filled('due_time')) {
            $dados['due_date'] = $request->due_date . ' ' . $request->due_time;
        }
    
        if ($request->has('is_complete')) {
            $dados['is_complete'] = true;
        }

        if(Project::create($dados)){
            return redirect()->route('projetos.index');
        }else{
            return back()->with('error', 'Erro ao criar projeto');
        }
    }

    public function show(Project $projeto)
    {
        return view('app.projects.show', ['projeto' => $projeto]);
    }

    public function edit(Project $projeto)
    {
        $user_id = Auth::id();
        $users = User::all();

        $dueDateTime = Carbon::parse($projeto->due_date);

        $projeto->due_date = $dueDateTime->format('Y-m-d'); 
        $projeto->due_time = $dueDateTime->format('H:i'); 
        
        return view('app.projects.edit', ['projeto' => $projeto, 'users' => $users]);
    }


    public function update(Request $request, Project $projeto)
    {
        $rules = [
            'project_name' => 'required|min:5|max:255',
            'project_description' => 'required|min:5|max:255',
            'due_date' => 'date',
        ];

        $feedback = [
            'required' => 'O campo :attribute é obrigatório',
            'min' => 'O campo :attribute precisa ter no mínimo :min caracteres',
            'max' => 'O campo :attribute pode ter no máximo :max caracteres',
            'date' => 'O campo :attribute está preenchido incorretamente',
            'time' => 'O campo :attribute está preenchido incorretamente',
        ];

        $dados = $request->only(['project_name','project_description','user_id']);

        $request->validate($rules, $feedback);

        if ($request->has('is_complete')) {
            $dados['is_complete'] = true;
        }else{
            $dados['is_complete'] = false;
        }

        if ($request->filled('due_date') && $request->filled('due_time')) {
            $dados['due_date'] = $request->due_date . ' ' . $request->due_time;
        }

        $projeto->update($dados);

        return redirect()->route('projetos.show', ['projeto' => $projeto->id]);
    }

    public function destroy(Project $projeto)
    {
        $user_id = Auth::id();
        

        $projeto->delete();

        return redirect()->route('projetos.index');
    }
}