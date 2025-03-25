<x-app-layout>
    <div class="container py-5">
        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <h2 class="fw-semibold text-dark">
                    {{ __('Lista de de Projetos') }}
                </h2>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Título</th>
                                <th scope="col">Descrição</th>
                                <th scope="col">Previsão de conclusão</th>
                                <th scope="col">Situação</th>
                                <th scope="col">Status</th>
                                <th scope="col">Qtd. tarefas</th>
                                <th scope="col">Atribuído a</th>
                                <th scope="col">Criação</th>
                                <th scope="col">Atualização</th>
                                <th scope="col" colspan="3">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($projects as $project)
                                <tr {{ $project->user_id == auth()->user()->id ? 'class=table-success' : 'class=table-active' }}>
                                    <td>{{ $project->id }}</td>
                                    <td>{{ $project->project_name }}</td>
                                    <td>{{ $project->project_description }}</td>
                                    <td>{{ $project->due_date }}</td>
                                    <td>{{ $project->status }}</td>
                                    <td>{{ $project->is_complete ? 'Finalizada' : 'Pendente' }}</td>
                                    <td>{{ $project->tasks_count }}</td>
                                    <td>{{ $project->user->name ?? 'N/A' }}</td>
                                    <td>{{ $project->created_at->format('d/m/Y H:i:s') }}</td>
                                    <td>{{ $project->updated_at->format('d/m/Y H:i:s') }}</td>
                                    <td>
                                        <a href="{{ route('projetos.edit', ['projeto' => $project->id]) }}" class="btn btn-secondary">Editar</a>
                                        <a href="{{ route('projetos.show', ['projeto' => $project->id]) }}" class="btn btn-info">Visualizar</a>
                                        <form id="form_{{ $project->id }}" method="POST" action="{{ route('projetos.destroy', ['projeto' => $project->id]) }}">
                                            @csrf
                                            @method('DELETE')
                                            <a href="#" onclick="document.getElementById('form_{{ $project->id }}').submit()" class="btn btn-danger">Excluir</a>
                                        </form>
                                    </td>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>