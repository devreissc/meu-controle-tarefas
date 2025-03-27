<x-app-layout>
    <div class="container py-5">
        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <h2 class="fw-semibold text-dark">
                    {{ __('Lista de de Subtarefas') }}
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
                                <th scope="col">Criação</th>
                                <th scope="col">Atualização</th>
                                <th scope="col">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($subtarefas as $subtarefa)
                                <tr>
                                    <td>{{ $subtarefa->id }}</td>
                                    <td>{{ $subtarefa->subtask_name }}</td>
                                    <td>{{ $subtarefa->subtask_description }}</td>
                                    <td>{{ $subtarefa->due_date }}</td>
                                    <td>{{ $subtarefa->status }}</td>
                                    <td>{{ $subtarefa->is_complete ? 'Finalizada' : 'Pendente' }}</td>
                                    <td>{{ $subtarefa->created_at->format('d/m/Y H:i:s') }}</td>
                                    <td>{{ $subtarefa->updated_at->format('d/m/Y H:i:s') }}</td>
                                    <td>
                                        <a href="{{ route('subtarefas.edit', ['subtarefa' => $subtarefa->id]) }}" class="btn btn-secondary">Editar</a>
                                        <a href="{{ route('subtarefas.show', ['subtarefa' => $subtarefa->id]) }}" class="btn btn-info">Visualizar</a>
                                        <form id="form_{{ $subtarefa->id }}" method="POST" action="{{ route('subtarefas.destroy', ['subtarefa' => $subtarefa->id]) }}">
                                            @csrf
                                            @method('DELETE')
                                            <a href="#" onclick="document.getElementById('form_{{ $subtarefa->id }}').submit()" class="btn btn-danger">Excluir</a>
                                        </form>
                                    </td>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $subtarefas->appends($request)->links() }}
                    <br>Exibindo {{ $subtarefas->count() }} subtarefas de {{ $subtarefas->total() }} (de {{ $subtarefas->firstItem() }} a {{ $subtarefas->lastItem() }})
                </div>
            </div>
        </div>
    </div>
</x-app-layout>