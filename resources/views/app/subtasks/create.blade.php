<x-app-layout>
    <div class="d-flex align-items-center justify-content-center vh-100 bg-light">
        <div class="p-4 bg-white shadow rounded" style="width: 100%; max-width: 400px;">
            <h3 class="text-center mb-3">Nova subtarefa</h3>
            
            <x-form-create-edit-subtask :users="$users" :tasks="$tasks" :action="route('subtarefas.store')" />

        </div>
    </div>
</x-app-layout>