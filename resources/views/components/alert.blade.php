@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
        <span>{{ session('success') }}</span>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
