@extends('layouts.app')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h4 class="mb-0">User Management</h4>
        </div>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#userModal" id="btnAddUser">
            <i class="bi bi-person-plus me-2"></i>Add User
        </button>
    </div>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar me-2">{{ substr($user->name, 0, 1) }}</div>
                                    {{ $user->name }}
                                </div>
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->created_at->format('M d, Y') }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <button class="btn btn-sm btn-outline-info btn-view" 
                                        data-id="{{ $user->id }}" 
                                        data-name="{{ $user->name }}" 
                                        data-email="{{ $user->email }}" 
                                        data-created="{{ $user->created_at }}">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-secondary btn-edit" 
                                        data-id="{{ $user->id }}" 
                                        data-name="{{ $user->name }}" 
                                        data-email="{{ $user->email }}">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger btn-delete" data-id="{{ $user->id }}" data-name="{{ $user->name }}">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">
                                <i class="bi bi-inbox" style="font-size: 2rem;"></i>
                                <p>No users found</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="userModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalTitle">Create User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" id="userForm" action="{{ route('admin.users.store') }}">
                @csrf
                <input type="hidden" name="_method" id="formMethod" value="POST">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="modalName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="modalName" name="name" required autofocus>
                    </div>
                    <div class="mb-3">
                        <label for="modalEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="modalEmail" name="email" required>
                    </div>
                    <div class="mb-3" id="passwordFields">
                        <label for="modalPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="modalPassword" name="password">
                    </div>
                    <div class="mb-3" id="passwordConfirmFields">
                        <label for="modalPasswordConfirmation" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="modalPasswordConfirmation" name="password_confirmation">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="submitBtn">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="viewUserModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">User Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-4">
                    <div class="avatar avatar-lg mx-auto mb-3" id="viewAvatar"></div>
                    <h4 id="viewName"></h4>
                    <p class="text-muted" id="viewEmail"></p>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <p class="mb-1"><strong>User ID:</strong></p>
                        <p class="text-muted" id="viewId">-</p>
                    </div>
                    <div class="col-md-6">
                        <p class="mb-1"><strong>Created:</strong></p>
                        <p class="text-muted" id="viewCreated">-</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.getElementById('btnAddUser').addEventListener('click', function() {
    document.getElementById('userModalTitle').textContent = 'Create User';
    document.getElementById('userForm').action = '{{ route("admin.users.store") }}';
    document.getElementById('formMethod').value = 'POST';
    document.getElementById('submitBtn').textContent = 'Create';
    document.getElementById('modalName').value = '';
    document.getElementById('modalEmail').value = '';
    document.getElementById('modalPassword').value = '';
    document.getElementById('modalPasswordConfirmation').value = '';
    document.getElementById('passwordFields').style.display = 'block';
    document.getElementById('passwordConfirmFields').style.display = 'block';
    document.getElementById('modalPassword').required = true;
});

document.querySelectorAll('.btn-edit').forEach(btn => {
    btn.addEventListener('click', function(e) {
        e.stopPropagation();
        const id = this.dataset.id;
        const name = this.dataset.name;
        const email = this.dataset.email;
        
        document.getElementById('userModalTitle').textContent = 'Edit User';
        document.getElementById('userForm').action = '/admin/users/' + id;
        document.getElementById('formMethod').value = 'PUT';
        document.getElementById('submitBtn').textContent = 'Update';
        document.getElementById('modalName').value = name;
        document.getElementById('modalEmail').value = email;
        document.getElementById('modalPassword').value = '';
        document.getElementById('modalPasswordConfirmation').value = '';
        document.getElementById('passwordFields').style.display = 'none';
        document.getElementById('passwordConfirmFields').style.display = 'none';
        document.getElementById('modalPassword').required = false;
        
        var modal = new bootstrap.Modal(document.getElementById('userModal'));
        modal.show();
    });
});

document.querySelectorAll('.btn-view').forEach(btn => {
    btn.addEventListener('click', function(e) {
        e.stopPropagation();
        const id = this.dataset.id || '-';
        const name = this.dataset.name || '-';
        const email = this.dataset.email || '-';
        const created = this.dataset.created || '-';
        
        document.getElementById('viewId').textContent = id;
        document.getElementById('viewName').textContent = name;
        document.getElementById('viewEmail').textContent = email;
        document.getElementById('viewAvatar').textContent = name.charAt(0).toUpperCase();
        document.getElementById('viewCreated').textContent = created;
        
        var modal = new bootstrap.Modal(document.getElementById('viewUserModal'));
        modal.show();
    });
});

document.querySelectorAll('.btn-delete').forEach(btn => {
    btn.addEventListener('click', function(e) {
        e.stopPropagation();
        const id = this.dataset.id;
        const name = this.dataset.name;
        
        if (confirm('Are you sure you want to delete user "' + name + '"?')) {
            fetch('/admin/users/' + id, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showToast('success', data.message || 'User deleted successfully');
                    setTimeout(() => location.reload(), 1500);
                } else {
                    showToast('danger', data.message || 'Failed to delete user');
                }
            })
            .catch(error => {
                showToast('danger', 'An error occurred. Please try again.');
            });
        }
    });
});

document.getElementById('userForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const form = this;
    const formData = new FormData(form);
    const method = document.getElementById('formMethod').value;
    const url = form.action;
    
    fetch(url, {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            bootstrap.Modal.getInstance(document.getElementById('userModal')).hide();
            showToast('success', data.message || 'Operation successful');
            setTimeout(() => location.reload(), 1500);
        } else if (data.errors) {
            let errorMsg = '';
            for (const [key, value] of Object.entries(data.errors)) {
                errorMsg += value[0] + '\n';
            }
            showToast('danger', errorMsg);
        }
    })
    .catch(error => {
        showToast('danger', 'An error occurred. Please try again.');
    });
});

function showToast(type, message) {
    const toast = document.createElement('div');
    toast.className = `toast align-items-center text-white bg-${type} border-0`;
    toast.setAttribute('role', 'alert');
    toast.setAttribute('aria-live', 'assertive');
    toast.setAttribute('aria-atomic', 'true');
    toast.innerHTML = `
        <div class="d-flex">
            <div class="toast-body">${message}</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    `;
    document.getElementById('toastContainer').appendChild(toast);
    new bootstrap.Toast(toast).show();
}
</script>
@endpush
@endsection