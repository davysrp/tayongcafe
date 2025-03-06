<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Roles Management') }}
        </h2>
    </x-slot>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="{{ route('roles.create') }}" class="btn btn-primary btn-sm">Add Role</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Role Name</th>
                        <th>Permissions</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                        <tr>
                            <td>{{ $role->id }}</td>
                            <td>{{ $role->name }}</td>
                            <td>
                                @foreach ($role->permissions as $permission)
                                    <span class="badge badge-info">{{ $permission->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <button class="btn btn-danger btn-sm delete-role" data-id="{{ $role->id }}">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        document.querySelectorAll('.delete-role').forEach(button => {
            button.addEventListener('click', function() {
                let id = this.getAttribute('data-id');
                if (confirm('Are you sure you want to delete this role?')) {
                    fetch(`/roles/${id}`, {
                        method: 'DELETE',
                        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
                    }).then(res => res.json())
                      .then(data => location.reload());
                }
            });
        });
    </script>
</x-admin-layout>
