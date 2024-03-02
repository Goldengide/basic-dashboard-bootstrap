
<div>
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="text-end">
                <input type="file" wire:model="upload" class="form-control d-none" id="uploadInput" accept="image/*">
                <label for="uploadInput" class="btn btn-primary">Upload Image</label>
            </div>
        </div>
    </div>
    <div class="row">
        @foreach ($images as $image)
        <div class="col-md-4 mb-4">
            <div class="card {{ in_array($image->id, $selectedImages) ? 'selected' : '' }}">
                <input type="checkbox" wire:model="selectedImages" value="{{ $image->id }}" class="position-absolute m-3">
                <div style="height: 200px; overflow: hidden;"> <!-- Set a fixed height for the image container -->
                    <img src="{{ $image->getUrl() }}" class="card-img-top" alt="{{ $image->title }}" style="object-fit: cover; height: 100%;"> <!-- Ensure the image fills the container and maintain aspect ratio -->
                </div>
                <div class="card-body border border-light">
                    <h5 class="card-title text-center">{{ $image->name }}</h5>
                    <!-- Add any additional image details here -->
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="mt-4">
        @if(count($images) > 0)
        <button wire:click="deleteSelectedImages" class="btn btn-danger" @if(empty($selectedImages)) disabled @endif>Delete Selected</button>
        @endif
        {{ $images->links() }} <!-- Pagination links -->
    </div>
</div>