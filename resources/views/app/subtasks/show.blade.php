<x-app-layout>
    <div class="container py-5">
        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <h2 class="fw-semibold text-dark">
                    {{ __('Subtarefa') }}
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
                                    
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>