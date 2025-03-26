@props(['action'])

<form method="POST" action="{{ $action }}">
    @csrf
    @if(isset($projeto))
        @method('PUT')
    @endif

    <div class="mb-3">
        <label for="user_id" class="form-label">Responsável</label>
        <select class="form-select" id="user_id" name="user_id">
            <option value="">Selecione uma responsável</option>
            @foreach($users as $user)
                <option value="{{ $user->id }}" {{ old('user_id', $projeto?->user_id ?? auth()->id()) == $user->id ? 'selected' : '' }}>{{ ($user->id == Auth::id()) ||  ($projeto?->user_id == $user->id) ? 'Eu mesmo' : $user->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="project_name" class="form-label">Projeto</label>
        <input type="text" class="form-control" id="project_name" name="project_name" value="{{ old('project_name', $projeto?->project_name) }}">
        {{ $errors->has('project_name') ? $errors->first('project_name') : '' }}
    </div>
    <div class="mb-3">
        <label for="project_description" class="form-label">Descrição</label>
        <textarea class="form-control" id="project_description" name="project_description" rows="3">{{ old('project_description', $projeto?->project_description) }}</textarea>
        {{ $errors->has('project_description') ? $errors->first('project_description') : '' }}
    </div>
    <div class="mb-3">
        <label for="due_date" class="form-label">Data de conclusão</label>
        <input type="date" class="form-control" id="due_date" name="due_date" value="{{ old('due_date', $projeto?->due_date) }}">
        {{ $errors->has('due_date') ? $errors->first('due_date') : '' }}
    </div>
    <div class="mb-3">
        <label for="due_date" class="form-label">Horário de conclusão</label>
        <input type="time" class="form-control" id="due_time" name="due_time" value="{{ old('due_time', $projeto?->due_time) }}">
        {{ $errors->has('due_time') ? $errors->first('due_time') : '' }}
    </div>
    <div class="mb-3 form-check">
        <input type="checkbox" name="is_complete" class="form-check-input" id="is_complete" {{ ($projeto?->is_complete ?? old('is_complete')) ? 'checked' : '' }}>
        <label class="form-check-label" for="is_complete">Concluído</label>
    </div>
    <button type="submit" class="btn btn-primary">Salvar</button>
</form>