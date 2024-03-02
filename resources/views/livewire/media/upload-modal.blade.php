<div wire:ignore.self x-data="{ isOpen: false }">
    
    <button wire:click="$emit('openModal')" class="mt-lg-0 mt-md-0 mt-3 btn btn-primary btn-icon">Upload</button>

    <div x-show="isOpen" x-cloak @close.away="isOpen = false">
        <div class="modal">
            <div class="modal-content">
                <h2 class="modal-title">Upload Image</h2>
                <div class="form-group">
                    <label for="image">Select Image (Drag and Drop or Browse)</label>
                    <input wire:model="image" type="file" id="image" accept="image/*">
                    @error('image') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div wire:loading wire:target="image">Uploading...</div>
                <button wire:click="uploadImage" @click.prevent wire:loading.attr="disabled" class="btn btn-primary">Upload</button>
                <button wire:click="removeImage" class="btn btn-secondary">Cancel</button>
            </div>
        </div>
    </div>
</div>

<script>
    

    document.addEventListener('livewire:load', function () {
    Livewire.on('openModal', () => {
        console.log('open')
        isOpen = true;
    });

    Livewire.on('closeModal', () => {
        isOpen = false;
    });
});
</script>
