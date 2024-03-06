<x-app-layout :assets="$assets ?? []">
    <div class="row mt-5">
        <form class="row g-3 needs-validation" novalidate="">
            <div class="container">
                <div class="row">
                    <div class="col-md-9 col-sm-12">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="post-title" class="form-label">Post Title</label>
                                    <input type="text" class="form-control" id="post-title" name="title"
                                        required="">
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                

                                <div class="col-md-12">
                                    <label for="post-content" class="form-label">Content</label>
                                    <textarea type="text" class="form-control" id="post-content" required=""></textarea>
                                    <div class="invalid-feedback">
                                        Content can't be empty.
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="validationCustom04" class="form-label">State</label>
                                    <select class="form-select" id="validationCustom04" required="">
                                        <option selected="" disabled="" value="">Choose...</option>
                                        <option>...</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Please select a valid state.
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="validationCustom05" class="form-label">Zip</label>
                                    <input type="text" class="form-control" id="validationCustom05" required="">
                                    <div class="invalid-feedback">
                                        Please provide a valid zip.
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="invalidCheck"
                                            required="">
                                        <label class="form-check-label" for="invalidCheck">
                                            Agree to terms and conditions
                                        </label>
                                        <div class="invalid-feedback">
                                            You must agree before submitting.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary" type="submit">Submit form</button>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-sm-12 col-md-3">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="validationCustom04" class="form-label">Post Category</label>
                                    <select class="form-select" id="validationCustom04" required="">
                                        <option selected="" disabled="" value="">Choose...</option>
                                        <option>...</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Please select a valid state.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </form>
        @livewire('media.tiny-mce-image-selector')
    </div>
    @push('scripts')
        <script src="https://cdn.tiny.cloud/1/9x9xigc8eqz16ard8itb0jdna8ujtrzhkjhxnabjtdj4a9v9/tinymce/6/tinymce.min.js">
        </script>
        <script>
            document.addEventListener('livewire:load', function() {
                tinymce.init({
                    selector: '#post-content',
                    plugins: 'autolink lists link image charmap print preview anchor image',
                    toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify| image | bullist numlist outdent indent | removeformat | help',
                    file_picker_types: 'image',
                    image_caption: true,
                    file_picker_callback: (callback, value, meta) => {
                        // Provide image and alt text for the image dialog
                        if (meta.filetype == 'image') {
                            $('#imageModal').modal('show');

                            // Listen for the imageSelected event emitted from Livewire
                            Livewire.on('imageSelected', (imageUrl) => {
                                // If imageUrl is an array, select the first one
                                if (Array.isArray(imageUrl)) {
                                    callback(imageUrl[0]);
                                } else {
                                    callback(imageUrl);
                                }

                                // Close the modal after the selection is made
                                $('#imageModal').modal('hide');
                            });
                        }

                    },
                    setup: function(editor) {
                        editor.ui.registry.addButton('image', {
                            icon: 'image',
                            tooltip: 'Insert Image',
                            onAction: function(_) {
                                // Open the Livewire image selector modal when the button is clicked
                                Livewire.emit('openImageSelector');
                            }
                        });
                    }
                });
            });
        </script>
    @endpush
</x-app-layout>
