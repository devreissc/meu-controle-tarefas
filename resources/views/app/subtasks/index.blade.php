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
                                    <td>{{ $task->created_at->format('d/m/Y H:i:s') }}</td>
                                    <td>{{ $task->updated_at->format('d/m/Y H:i:s') }}</td>
                                    <td>
                                        
                                    </td>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>