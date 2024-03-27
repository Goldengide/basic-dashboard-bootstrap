<x-app-layout :assets="$assets ?? []">
    <div>

        <div class="row mt-5">
            <div class="col-md-12 col-sm-6">
                <div class="container">
                    <form class="form-horizontal"action="{{ route('settings.update-title') }}" method="post">
                        @csrf
                        @method('PUT')
                        @foreach($settings as $setting)
                        <div class="form-group row">
                            <label class="control-label col-sm-3 align-self-center mb-0" for="{{$setting->slug}}">{{$setting->name}}:</label>
                            <div class="col-sm-9">
                            <input type="{{$setting->slug}}" class="form-control" name="{{ $setting->slug }}" id="{{$setting->slug}}" value="{{$setting->value}}">
                            </div>
                        </div>
                        @endforeach
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>

                    
                </div>
            </div>
        </div>

    </div>
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
    @section('additional')
        <script>
            $(document).ready(function() {
                $('#category-name').on('input', function() {
                    const nameValue = $(this).val().trim();
                    const slugValue = nameValue.toLowerCase().replace(/\s+/g, '-');
                    $('#slug').val(slugValue);
                    // checkSlug(slugValue);
                });

                $('.delete-button').on('click', function() {
                    var itemId = $(this).data('item-id');
                    // Display SweetAlert confirmation dialogue
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        // If user confirms deletion, perform delete action
                        if (result.isConfirmed) {
                            var form = $('<form>').attr({
                                method: 'POST',
                                action: "{{ route('categories.destroy', ['category' => ':itemId']) }}".replace(
                                    ':itemId', itemId)
                            });

                            // Add CSRF token input field
                            form.append($('<input>').attr({
                                type: 'hidden',
                                name: '_token',
                                value: '{{ csrf_token() }}'
                            }));

                            // Add method spoofing for DELETE request
                            form.append($('<input>').attr({
                                type: 'hidden',
                                name: '_method',
                                value: 'DELETE'
                            }));

                            // Append the form to the body and submit it
                            $('body').append(form);
                            form.submit();
                            
                        }
                    });
                });
            });

            function checkSlug(slug) {
                $.ajax({
                    url: "{{ route('check-slug.categories') }}",
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
    @endsection


</x-app-layout>
