@props(['action'])

@if($tasks->isEmpty())
    <p>Não existem tarefas para que atribuir essa subtarefa, por favor cadastre uma tarefa antes</p>
    <a class="btn btn-primary" href="{{ route('tarefas.create') }}">Nova tarefa</a>
@else
    <form method="POST" action="{{ $action }}">
        @csrf
        @if(isset($subtarefa))
            @method('PUT')
        @endif
        <div class="mb-3">
            <label for="user_id" class="form-label">Responsável</label>
            <select class="form-select" id="user_id" name="user_id">
                <option value="">Selecione uma responsável</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ old('user_id', $subtarefa?->user_id ?? auth()->id()) == $user->id ? 'selected' : '' }}>{{ $user->name }} {{ auth()->id() == $user->id ? '(Eu)' : '' }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="task_id" class="form-label">Tarefa</label>
            <select class="form-select" id="task_id" name="task_id">
                <option value="">Selecione uma tarefa</option>
                @foreach($tasks as $task)
                    <option value="{{ $task->id }}" {{ old('task_id', $subtarefa?->task_id) == $task->id ? 'selected' : '' }}>
                        {{ $task->task_name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="subtask_name" class="form-label">Subtarefa</label>
            <input type="text" class="form-control" id="subtask_name" name="subtask_name" value="{{ old('subtask_name', $subtarefa?->subtask_name) }}">
            {{ $errors->has('subtask_name') ? $errors->first('subtask_name') : '' }}
        </div>
        <div class="mb-3">
            <label for="subtask_description" class="form-label">Descrição</label>
            <textarea class="form-control" id="subtask_description" name="subtask_description" rows="3">{{ old('subtask_description', $subtarefa?->subtask_description) }}</textarea>
            {{ $errors->has('subtask_description') ? $errors->first('subtask_description') : '' }}
        </div>
        <div class="mb-3">
            <label for="due_date" class="form-label">Data de conclusão</label>
            <input type="date" class="form-control" id="due_date" name="due_date" value="{{ old('due_date', $subtarefa?->due_date) }}">
            {{ $errors->has('due_date') ? $errors->first('due_date') : '' }}
        </div>
        <div class="mb-3">
            <label for="due_date" class="form-label">Horário de conclusão</label>
            <input type="time" class="form-control" id="due_time" name="due_time" value="{{ old('due_time', $subtarefa?->due_time) }}">
            {{ $errors->has('due_time') ? $errors->first('due_time') : '' }}
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" name="is_complete" class="form-check-input" id="is_complete" {{ ($subtarefa?->is_complete ?? old('is_complete')) ? 'checked' : '' }}>
            <label class="form-check-label" for="is_complete">Finalizada</label>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endempty