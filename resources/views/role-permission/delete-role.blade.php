{{ Form::model($role, ['route' => ['role.destroy', $role->id], 'method' => 'delete']) }}
    <div class="form-group">
        <label class="form-label">permission title</label>
        {{ Form::text('title', old('title'), ['class' => 'form-control','id' => 'permission-title', 'placeholder' => 'Role Title', 'readonly']) }}
    </div>
    <button type="submit" class="btn btn-primary">Delete</button>
    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
{{ Form::close() }}