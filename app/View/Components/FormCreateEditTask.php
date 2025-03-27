<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FormCreateEditTask extends Component
{
    public $users;
    public $tarefa;
    public $projects;

    public function __construct($users, $projects = [], $tarefa = null)
    {
        $this->users = $users;
        $this->tarefa = $tarefa;
        $this->projects = $projects;
    }

    public function render(): View|Closure|string
    {
        return view('components.form-create-edit-task');
    }
}