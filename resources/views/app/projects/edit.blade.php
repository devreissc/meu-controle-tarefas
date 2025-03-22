<x-app-layout>
    <div class="d-flex align-items-center justify-content-center vh-100 bg-light">
        <div class="p-4 bg-white shadow rounded" style="width: 100%; max-width: 400px;">
            <h3 class="text-center mb-3">Novo projeto</h3>

            <form method="POST" action="{{ route('projetos.update', ['projeto' => $projeto]) }}">
                @csrf
                @method("PUT")
                <div class="mb-3">
                    <label for="project_name" class="form-label">Projeto</label>
                    <input type="text" class="form-control" id="project_name" name="project_name" value="{{ $projeto->project_name ?? old('project_name') }}">
                    {{ $errors->has('project_name') ? $errors->first('project_name') : '' }}
                </div>
                <div class="mb-3">
                    <label for="project_description" class="form-label">Descrição</label>
                    <textarea class="form-control" id="project_description" name="project_description" rows="3">{{ $projeto->project_description ?? old('project_description') }}</textarea>
                    {{ $errors->has('project_description') ? $errors->first('project_description') : '' }}
                </div>
                <div class="mb-3">
                    <label for="due_date" class="form-label">Data de conclusão</label>
                    <input type="date" class="form-control" id="due_date" name="due_date" value="{{ $projeto->due_date ?? old('due_date') }}">
                    {{ $errors->has('due_date') ? $errors->first('due_date') : '' }}
                </div>
                <div class="mb-3">
                    <label for="due_date" class="form-label">Horário de conclusão</label>
                    <input type="time" class="form-control" id="due_time" name="due_time" value="{{ $projeto->due_time ?? old('due_time') }}">
                    {{ $errors->has('due_time') ? $errors->first('due_time') : '' }}
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" name="is_complete" class="form-check-input" id="is_complete">
                    <label class="form-check-label" for="is_complete">Finalizada</label>
                </div>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </form>
        </div>
    </div>
</x-app-layout>