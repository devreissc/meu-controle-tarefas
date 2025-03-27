<x-app-layout>
    <div class="d-flex align-items-center justify-content-center vh-100 bg-light">
        <div class="p-4 bg-white shadow rounded" style="width: 100%; max-width: 400px;">
            <h3 class="text-center mb-3">Edição de tarefa</h3>
            
            <x-form-create-edit-task :users="$users" :projects="$projects" :tarefa="$tarefa" :action="route('tarefas.update', $tarefa)"/>
        </div>
    </div>
</x-app-layout>