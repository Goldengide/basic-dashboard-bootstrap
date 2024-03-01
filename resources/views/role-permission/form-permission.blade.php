@if (isset($permission))
    {{ Form::model($permission, ['route' => ['permission.update', $permission->id], 'method' => 'put']) }}
@else
    {{ Form::open(['route' => 'permission.store', 'method' => 'post']) }}
@endif

<div class="form-group">
    <label class="form-label">Permission Title</label>
    {{ Form::text('title', old('title', isset($permission) ? $permission->title : ''), ['class' => 'form-control', 'id' => 'permission-title', 'placeholder' => 'Permission Title', 'required']) }}
</div>


@if (isset($permission))
    <button type="submit" class="btn btn-primary">Update</button>
@else
    <button type="submit" class="btn btn-primary">Save</button>
@endif

<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>

{{ Form::close() }}
