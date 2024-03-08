<x-app-layout :assets="$assets ?? []">
    <div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title mb-0">Categories</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        @livewire('blog.category')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
