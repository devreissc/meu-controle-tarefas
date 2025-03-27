@props(['action'])
<form method="POST" action="{{ $action }}">
    @csrf
    @if(isset($tarefa))
        @method('PUT')
    @endif

    <div class="mb-3">
        <label for="project_id" class="form-label">Projeto</label>
        <select class="form-select" id="project_id" name="project_id">
            <option value="" selected>Selecione um projeto</option>
            @foreach($projects as $project)
                <option value="{{ $project->id }}" {{ old('project_id', $tarefa?->project_id ) == $project->id ? 'selected' : '' }}>{{ $project->project_name }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="user_id" class="form-label">Responsável</label>
        <select class="form-select" id="user_id" name="user_id">
            <option value="" selected>Selecione um responsável</option>
            @foreach($users as $user)
                <option value="{{ $user->id }}" {{ old('user_id', $tarefa?->user_id ) == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="task_name" class="form-label">Tarefa</label>
        <input type="text" class="form-control" id="task_name" name="task_name" value="{{ $tarefa->task_name ?? old('task_name') }}">
        {{ $errors->has('task_name') ? $errors->first('task_name') : '' }}
    </div>
    <div class="mb-3">
        <label for="task_description" class="form-label">Descrição</label>
        <textarea class="form-control" id="task_description" name="task_description" rows="3">{{ $tarefa->task_description ?? old('task_description') }}</textarea>
        {{ $errors->has('task_description') ? $errors->first('task_description') : '' }}
    </div>
    <div class="mb-3">
        <label for="due_date" class="form-label">Data de conclusão</label>
        <input type="date" class="form-control" id="due_date" name="due_date" value="{{ $tarefa->due_date ?? old('due_date') }}">
        {{ $errors->has('due_date') ? $errors->first('due_date') : '' }}
    </div>
    <div class="mb-3">
        <label for="due_date" class="form-label">Horário de conclusão</label>
        <input type="time" class="form-control" id="due_time" name="due_time" value="{{ $tarefa->due_time ?? old('due_time') }}">
        {{ $errors->has('due_time') ? $errors->first('due_time') : '' }}
    </div>
    <div class="mb-3 form-check">
        <input type="checkbox" name="is_complete" class="form-check-input" id="is_complete" {{ ($tarefa->is_complete ?? old('is_complete')) ? 'checked' : '' }}>
        <label class="form-check-label" for="is_complete">Concluído</label>
    </div>
    <button type="submit" class="btn btn-primary">Salvar</button>
</form>