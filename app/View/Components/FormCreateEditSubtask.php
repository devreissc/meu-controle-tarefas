<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FormCreateEditSubtask extends Component
{
    public $users;
    public $subtarefa;
    public $tasks;

    public function __construct($users, $subtarefa = null, $tasks = [])
    {
        $this->users = $users;
        $this->subtarefa = $subtarefa;
        $this->tasks = $tasks;
    }

    public function render(): View|Closure|string
    {
        return view('components.form-create-edit-subtask');
    }
}