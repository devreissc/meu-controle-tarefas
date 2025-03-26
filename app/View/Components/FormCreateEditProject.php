<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FormCreateEditProject extends Component
{
    public $users;
    public $projeto;

    public function __construct($users, $projeto = null)
    {
        $this->users = $users;
        $this->projeto = $projeto;
    }

    public function render(): View|Closure|string
    {
        return view('components.form-create-edit-project');
    }
}