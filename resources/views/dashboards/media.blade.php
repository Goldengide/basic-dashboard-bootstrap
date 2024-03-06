<x-app-layout :assets="$assets ?? []">
    <div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title mb-0">Media Manager</h4>
                        </div>
                        <div class="text-center ms-3 ms-lg-0 ms-md-0">

                            <a href="#" class="mt-lg-0 mt-md-0 mt-3 btn btn-primary btn-icon"
                                data-bs-toggle="tooltip" data-modal-form="form" data-icon="person_add" data-size="large"
                                data--href="{{ route('media.component') }}" data-app-title="Add new role"
                                data-placement="top" title="New Role">
                                <i class="btn-inner">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                </i>
                                <span>Upload</span>
                            </a>


                        </div>
                    </div>
                    <div class="card-body">
                        @livewire('media.image-view')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
