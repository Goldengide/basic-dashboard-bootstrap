<x-app-layout :assets="$assets ?? []">
    <div class="row mt-5">
        <form class="row g-3 needs-validation" novalidate="" action="{{ route('posts.store') }}" method="POST">
            @csrf
            <div class="container">
                <div class="row">
                    <div class="col-md-9 col-sm-12">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="post-title" class="form-label">Post Title <input type="hidden"
                                            name="slug" id="slug" readonly
                                            style="border: none; background: none"></label>
                                    <input type="text" class="form-control" id="post-title" name="title" value="{{old('title')}}"
                                        required="">
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <label for="post-content" class="form-label">Content</label>
                                    <textarea name="content" type="text" class="form-control" id="post-content" required="">{!! old('content') !!}</textarea>
                                    <div class="invalid-feedback">
                                        Content can't be empty.
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
                                <div class="col-md-12 my-2 ">
                                    <label for="validationCustom04" class="form-label">Publish Post</label>
                                    <select name="published" class="form-select" id="validationCustom04" required="">
                                            <option value="1" selected>Yes</option>
                                            <option value="0">No</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Please select a valid state.
                                    </div>
                                </div>
                                <div class="col-md-12 my-2">
                                    <label for="validationCustom04" class="form-label">Post Category</label>
                                    <select name="category_id" class="form-select" id="validationCustom04" required="">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        Please select a valid state.
                                    </div>
                                </div>
                                <div class="col-md-12 my-2">
                                    {!! featuredImageInput(
                                        'image_id',
                                        'images',
                                        'Featured Image',
                                        'post',
                                    ) !!}
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
        <x-image-modal>
            @livewire('media.image-view', ['type' => 'normal_single'])
        </x-image-modal>

        <script>
            Livewire.on('imageSelected', (data) => {
                $('#image_id').val(data.imageId);
                $('#image_id-src').attr('src', data.imageUrl);
                // Optionally, you can also use data.imageUrl if needed
            });
        </script>

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
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                $('#post-title').on('input', function() {
                    const nameValue = $(this).val().trim();
                    const slugValue = nameValue.toLowerCase().replace(/\s+/g, '-');
                    $('#slug').val(slugValue);
                    // checkSlug(slugValue);
                });


            });

            function checkSlug(slug) {
                $.ajax({
                    url: "{{ route('check-slug.post') }}",
                    type: 'POST',
                    data: {
                        slug: slug
                    },
                    success: function(response) {
                        if (response.exists) {
                            const newSlug = slug + '-' + response.count;
                            $('#slug').val(newSlug);
                        } else {
                            $('#slug').val(slug);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }
        </script>
    @endpush
</x-app-layout>
