<div>
    <label for="imageId" class="form-label">{{ $label }}</label>
    <div>
        <!-- Wrap the image with an anchor tag and add an onclick event -->
        <a href="#" data-bs-toggle="modal" data-bs-target="#addImageInput">
            <img src="{{ $imageUrl ?? asset('images/avatars/01.png') }}" alt="Featured Image" width="100" height="auto">
        </a>
    </div>
    <input type="hidden" class="form-control" id="imageId" wire:model="{{ $imageId }}" required>
    @error($imageId)
        <span class="text-danger">{{ $message }}</span>
    @enderror

    <!-- Modal markup (replace with your modal HTML) -->
    <div wire:ignore.self class="modal fade" id="addImageInput" tabindex="-1" aria-labelledby="addImageInputLabel" 
        aria-hidden="true" style="z-index: 9016; display: none">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @livewire('media.image-view', compact('type'))
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
