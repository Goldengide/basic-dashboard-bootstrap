
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
                <label>
                    <input type="{{ $allowMultipleSelection ? 'checkbox' : 'radio' }}" wire:model="{{ $allowMultipleSelection ? 'selectedImages' : 'selectedImage' }}" value="{{ $image->id }}" class="position-absolute m-3">
                    <div style="height: 200px; overflow: hidden;"> <!-- Set a fixed height for the image container -->
                        <img src="{{ $image->getUrl() }}" class="card-img-top" alt="{{ $image->title }}" style="object-fit: cover; height: 100%;"> <!-- Ensure the image fills the container and maintain aspect ratio -->
                    </div>
                </label>
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
        <button wire:click="deleteSelectedImages" class="btn btn-danger float-left" @if(empty($selectedImages)) disabled @endif>Delete Selected</button>
        <button wire:click="useSelectedImage" class="btn btn-danger float-left mx-2" >Use</button>
        @endif
        {{ $images->links() }} <!-- Pagination links -->

        {{-- <button wire:click="useSelectedImage" class="btn btn-danger float-left" >Use</button> --}}
    </div>
</div>