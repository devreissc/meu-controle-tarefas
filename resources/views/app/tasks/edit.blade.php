<x-app-layout>
    <div class="d-flex align-items-center justify-content-center vh-100 bg-light">
        <div class="p-4 bg-white shadow rounded" style="width: 100%; max-width: 400px;">
            <h3 class="text-center mb-3">Edição de tarefa</h3>

            <form method="POST" action="{{ route('tarefas.update', ['tarefa' => $tarefa]) }}">
                @csrf
                @method("PUT")
                <div class="mb-3">
                    <label for="project_id" class="form-label">Projeto</label>
                    <select class="form-select" id="project_id" name="project_id">
                        <option selected>Selecione um projeto</option>
                        @foreach($projects as $project)
                            <option value="{{ $project->id }}" {{ $tarefa->project_id == $project->id ? 'selected' : '' }}>{{ $project->project_name }}</option>
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
                    <input type="checkbox" name="is_complete" class="form-check-input" id="is_complete">
                    <label class="form-check-label" for="is_complete">Concluído</label>
                </div>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </form>
        </div>
    </div>
</x-app-layout>