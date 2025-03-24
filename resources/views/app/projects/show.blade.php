<style>
    .container-custom {
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .info-box {
        width: 250px;
        padding: 20px;
    }
    .table-container {
        flex-grow: 1;
        padding: 20px;
    }
</style>

<x-app-layout>
    <div class="container-fluid container-custom">
        <div class="d-flex">
            <!-- Informações do Projeto -->
            <div class="info-box">
                <p class="fw-bold">Informações do projeto</p>
                <p><strong>Nome do projeto: </strong> {{ $projeto->project_name }}</p>
                <p><strong>Descrição do projeto: </strong> {{ $projeto->project_description}}</p>
                <p><strong>Quantidade de tarefas: </strong></p>
                <p><strong>Porcentagem concluída: </strong></p>
                <p class="fw-bold">Situação: <span class="{{ $projeto->is_complete == 1 ? 'badge rounded-pill text-bg-success' : 'badge rounded-pill text-bg-warning' }}">{{ $projeto->is_complete == 1 ? 'Finalizado' : 'Aberto' }}</span></p>
                
            </div>

            <!-- Tabela com Tarefas -->
            <div class="table-container">
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
                                        <th scope="col">Subtarefas</th>
                                        <th scope="col">Criação</th>
                                        <th scope="col">Atualização</th>
                                        <th scope="col">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($projeto->tasks as $task)
                                    <tr {{ $task->user_id == auth()->user()->id ? 'class=table-success' : 'class=table-active' }}>
                                        <td>{{ $task->id }}</td>
                                        <td>{{ $task->task_name }}</td>
                                        <td>{{ $task->task_description }}</td>
                                        <td>{{ $task->due_date }}</td>
                                        <td>{{ $task->status }}</td>
                                        <td></td>
                                        <td>{{ $task->is_complete ? 'Finalizada' : 'Pendente' }}</td>
                                        <td>{{ $task->created_at->format('d/m/Y H:i:s') }}</td>
                                        <td>{{ $task->updated_at->format('d/m/Y H:i:s') }}</td>
                                        <td>
                                            
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>