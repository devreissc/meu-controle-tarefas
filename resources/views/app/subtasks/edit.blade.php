<x-app-layout>
    <div class="d-flex align-items-center justify-content-center vh-100 bg-light">
        <div class="p-4 bg-white shadow rounded" style="width: 100%; max-width: 400px;">
            <h3 class="text-center mb-3">Edição de subtarefa</h3>

            <form method="POST" action="{{ route('subtarefas.update', ['subtarefa' => $subtarefa]) }}">
                @csrf
                @method("PUT")
                <div class="mb-3">
                    <label for="task_id" class="form-label">Tarefa</label>
                    <select class="form-select" id="task_id" name="task_id">
                        <option selected>Selecione uma tarefa</option>
                        @foreach($tasks as $task)
                            <option value="{{ $task->id }}" {{ $subtarefa->task_id == $task->id ? 'selected' : '' }} >{{ $task->task_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="subtask_name" class="form-label">Subtarefa</label>
                    <input type="text" class="form-control" id="subtask_name" name="subtask_name" value="{{ $subtarefa->subtask_name ?? old('subtask_name') }}">
                    {{ $errors->has('subtask_name') ? $errors->first('subtask_name') : '' }}
                </div>
                <div class="mb-3">
                    <label for="subtask_description" class="form-label">Descrição</label>
                    <textarea class="form-control" id="subtask_description" name="subtask_description" rows="3">{{ $subtarefa->subtask_description ?? old('subtask_description') }}</textarea>
                    {{ $errors->has('subtask_description') ? $errors->first('subtask_description') : '' }}
                </div>
                <div class="mb-3">
                    <label for="due_date" class="form-label">Data de conclusão</label>
                    <input type="date" class="form-control" id="due_date" name="due_date" value="{{ $subtarefa->due_date ?? old('due_date') }}">
                    {{ $errors->has('due_date') ? $errors->first('due_date') : '' }}
                </div>
                <div class="mb-3">
                    <label for="due_date" class="form-label">Horário de conclusão</label>
                    <input type="time" class="form-control" id="due_time" name="due_time" value="{{ $subtarefa->due_time ?? old('due_time') }}">
                    {{ $errors->has('due_time') ? $errors->first('due_time') : '' }}
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" name="is_complete" class="form-check-input" id="is_complete" {{ ($subtarefa->is_complete ?? old('is_complete')) ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_complete">Concluído</label>
                </div>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </form>
        </div>
    </div>
</x-app-layout>