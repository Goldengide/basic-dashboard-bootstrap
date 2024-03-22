<div>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" 
        aria-hidden="true" style="z-index: 9010; display: none">
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
