<x-app-layout>
    <div class="container py-5">
        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <h2 class="fw-semibold text-dark">
                    {{ __('Lista de de Tarefa') }}
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
                                <th scope="col">Qtd. subtarefas</th>
                                <th scope="col">Atribuído a</th>
                                <th scope="col">Criação</th>
                                <th scope="col">Atualização</th>
                                <th scope="col">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tasks as $task)
                                <tr {{ $task->user_id == auth()->user()->id ? 'class=table-success' : 'class=table-active' }}>
                                    <td>{{ $task->id }}</td>
                                    <td>{{ $task->task_name }}</td>
                                    <td>{{ $task->task_description }}</td>
                                    <td>{{ $task->due_date }}</td>
                                    <td>{{ $task->status }}</td>
                                    <td>{{ $task->is_complete ? 'Finalizada' : 'Pendente' }}</td>
                                    <td>{{ $task->subtasks_count }}</td>
                                    <td>{{ $task->user->name ?? 'N/A' }}</td>
                                    
                                    <td>{{ $task->created_at->format('d/m/Y H:i:s') }}</td>
                                    <td>{{ $task->updated_at->format('d/m/Y H:i:s') }}</td>
                                    <td>
                                        <a href="{{ route('tarefas.edit', ['tarefa' => $task->id]) }}" class="btn btn-secondary">Editar</a>
                                        <a href="{{ route('tarefas.show', ['tarefa' => $task->id]) }}" class="btn btn-info">Visualizar</a>
                                        <form id="form_{{ $task->id }}" method="POST" action="{{ route('tarefas.destroy', ['tarefa' => $task->id]) }}">
                                            @csrf
                                            @method('DELETE')
                                            <a href="#" onclick="document.getElementById('form_{{ $task->id }}').submit()" class="btn btn-danger">Excluir</a>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $tasks->appends($request)->links() }}
                    <br>Exibindo {{ $tasks->count() }} tarefas de {{ $tasks->total() }} (de {{ $tasks->firstItem() }} a {{ $tasks->lastItem() }})
                </div>
            </div>
        </div>
    </div>
</x-app-layout>