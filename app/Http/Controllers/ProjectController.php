<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = auth()->user()->projects;
        return view('app.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('app.projects.create');
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

        $dados = $request->only(['project_name','project_description']);
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
        return view('app.projects.show');
    }

    public function edit(Project $projeto)
    {
        $user_id = Auth::id();

        if($projeto->user_id != $user_id){
            return 'acesso negado';
        }

        // Converte a data em um objeto Carbon
        $dueDateTime = Carbon::parse($projeto->due_date);

        // Separa a data e a hora
        $projeto->due_date = $dueDateTime->format('Y-m-d'); // Exemplo: 2025-03-22
        $projeto->due_time = $dueDateTime->format('H:i');   // Exemplo: 13:58
        
        return view('app.projects.edit', ['projeto' => $projeto]);
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

        $request->validate($rules, $feedback);

        $user_id = Auth::user()->id;
        if($projeto->user_id != $user_id){
            return 'acesso-negado';
        }

        $projeto->update($request->all());

        return redirect()->route('projetos.show', ['projeto' => $projeto->id]);
    }

    public function destroy(Project $projeto)
    {
        $user_id = Auth::id();
        
        if($projeto->user_id != $user_id){
            return 'acesso negado';
        }

        $projeto->delete();

        return redirect()->route('projetos.index');
    }
}
