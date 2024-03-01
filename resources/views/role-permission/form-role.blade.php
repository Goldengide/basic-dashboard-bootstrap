@if(isset($role))
    {{ Form::model($role, ['route' => ['role.update', $role->id], 'method' => 'put']) }}
@else
    {{ Form::open(['route' => 'role.store','method' => 'post']) }}
@endif

<div class="form-group">
    <label class="form-label">Role Title</label>
    {{ Form::text('title', old('title', isset($role) ? $role->title : ''), ['class' => 'form-control', 'id' => 'role-title', 'placeholder' => 'Role Title', 'required']) }}
</div>
<label class="form-label">Status</label>
<div class="form-check">
    {{ Form::radio('status', '1', isset($role) && $role->status == 1, ['class' => 'form-check-input', 'id' => 'roleassigned']) }}
    <label class="form-check-label" for="roleassigned">Yes</label>
</div>
<div class="mb-3 form-check">
    {{ Form::radio('status', '0', isset($role) && $role->status == 0, ['class' => 'form-check-input', 'id' => 'rolenotassigned']) }}
    <label class="form-check-label" for="rolenotassigned">No</label>
</div>

@if(isset($role))
    <button type="submit" class="btn btn-primary">Update</button>
@else
    <button type="submit" class="btn btn-primary">Save</button>
@endif

<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>


{{ Form::close() }}
