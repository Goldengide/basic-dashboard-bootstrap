<x-app-layout :assets="$assets ?? []">
    <div>

        <div class="row mt-5">
            <div class="col-md-8 col-sm-6">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Category List</h4>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <div class="text-end">
                                    <a href="{{ route('categories.index') }}" class="btn btn-primary">Add Categories</a>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-body px-0">
                        <div class="table-responsive">
                            <table id="post-list-table" class="table table-striped" role="grid">
                                <thead>
                                    <tr class="ligth">
                                        <th>Name</th>
                                        <th>Icon</th>
                                        <th>Slug</th>
                                        <th style="min-width: 100px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $categoryItem)
                                        <tr>

                                            <td>{{ $categoryItem->name }}</td>
                                            <td><i class="{{ $categoryItem->icon }} mx-2"></i> </td>
                                            <td>{{ $categoryItem->slug }}</td>
                                            <td>
                                                <div class="flex align-items-center list-post-action">

                                                    <a class="btn btn-sm btn-icon btn-warning" data-toggle="tooltip"
                                                        data-placement="top" title="" data-original-title="Edit"
                                                        href="{{ route('categories.edit', ['category' => $categoryItem->id]) }}">
                                                        <span class="btn-inner">
                                                            <svg width="20" viewBox="0 0 24 24" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M11.4925 2.78906H7.75349C4.67849 2.78906 2.75049 4.96606 2.75049 8.04806V16.3621C2.75049 19.4441 4.66949 21.6211 7.75349 21.6211H16.5775C19.6625 21.6211 21.5815 19.4441 21.5815 16.3621V12.3341"
                                                                    stroke="currentColor" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round">
                                                                </path>
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M8.82812 10.921L16.3011 3.44799C17.2321 2.51799 18.7411 2.51799 19.6721 3.44799L20.8891 4.66499C21.8201 5.59599 21.8201 7.10599 20.8891 8.03599L13.3801 15.545C12.9731 15.952 12.4211 16.181 11.8451 16.181H8.09912L8.19312 12.401C8.20712 11.845 8.43412 11.315 8.82812 10.921Z"
                                                                    stroke="currentColor" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round">
                                                                </path>
                                                                <path d="M15.1655 4.60254L19.7315 9.16854"
                                                                    stroke="currentColor" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round">
                                                                </path>
                                                            </svg>
                                                        </span>
                                                    </a>
                                                    <a class="btn btn-sm btn-icon btn-danger delete-button" data-toggle="tooltip"
                                                        data-placement="top" title="" data-original-title="Delete"
                                                        href="javascript:void(0)" data-item-id = "{{$categoryItem->id}}">
                                                        <span class="btn-inner">
                                                            <svg width="20" viewBox="0 0 24 24" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg"
                                                                stroke="currentColor">
                                                                <path
                                                                    d="M19.3248 9.46826C19.3248 9.46826 18.7818 16.2033 18.4668 19.0403C18.3168 20.3953 17.4798 21.1893 16.1088 21.2143C13.4998 21.2613 10.8878 21.2643 8.27979 21.2093C6.96079 21.1823 6.13779 20.3783 5.99079 19.0473C5.67379 16.1853 5.13379 9.46826 5.13379 9.46826"
                                                                    stroke="currentColor" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round">
                                                                </path>
                                                                <path d="M20.708 6.23975H3.75" stroke="currentColor"
                                                                    stroke-width="1.5" stroke-linecap="round"
                                                                    stroke-linejoin="round"></path>
                                                                <path
                                                                    d="M17.4406 6.23973C16.6556 6.23973 15.9796 5.68473 15.8256 4.91573L15.5826 3.69973C15.4326 3.13873 14.9246 2.75073 14.3456 2.75073H10.1126C9.53358 2.75073 9.02558 3.13873 8.87558 3.69973L8.63258 4.91573C8.47858 5.68473 7.80258 6.23973 7.01758 6.23973"
                                                                    stroke="currentColor" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round">
                                                                </path>
                                                            </svg>
                                                        </span>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="container">

                    <form action="{{ route('categories.update', ['category' => $category->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row mb-4">
                            <div class="my-2">
                                <div class="text-start">
                                    <h4 class="border-bottom border-light pb-4">Edit Category</h4>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="my-2">
                                <label for="category-name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="category-name" name="name"
                                    value="{{ old('name', $category->name) }}" required="">
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>


                            <div class="my-2">
                                <label for="category-icon" class="form-label">Icon Class (<a
                                        href="https://www.flaticon.com/uicons/interface-icons" target="_blank">Choose
                                        icons</a>)</label>
                                <input type="text" class="form-control" id="icon" name="icon"
                                    value="{{ old('icon', $category->icon) }}" placeholder="fi fi-rr-eye">
                            </div>
                            <div class="my-2">
                                <label for="slug" class="form-label">Slug</label>
                                <input type="text" class="form-control" id="slug" name="slug"
                                    value="{{ old('slug', $category->slug) }}">
                            </div>
                            <div class="my-2">
                                {!! featuredImageInput(
                                    'image_id',
                                    'images',
                                    'Featured Image (use a banner size preferrably for best experience)',
                                    'banner',
                                    old('image_id', $category->image_id),
                                ) !!}
                            </div>
                            <div class="col-12  my-2">
                                <button class="btn btn-primary" type="submit">Submit form</button>

                            </div>
                            <div>


                                <!-- Modal markup (replace with your modal HTML) -->

                            </div>

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
