<div>
    <div class="row">
        <div class="col-lg-12">
        </div>
    </div>
    <div class="row" id="job-list">
        @isset($plugins)
            @foreach ($plugins as $plugin)
                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/ba/Stripe_Logo%2C_revised_2016.svg/2560px-Stripe_Logo%2C_revised_2016.svg.png"
                                alt="" class="w-100">
                            <a href="#!">
                                <h2>{{ $plugin->name }}</h2>
                            </a>
                            <p class="text-white badge bg-info"> <strong>{{ $plugin->type->name }}</strong> </p>
                            <p class="text-muted">{{ $plugin->description }}</p>
                            <div class="mt-4 hstack gap-2">
                                @if (!$plugin->installed)
                                    <button wire:click="enablePlugin('{{ $plugin->uuid }}')" type="button"
                                        class="btn btn-info btn-label waves-effect waves-light rounded-pill">
                                        <i class="ri-add-fill label-icon align-middle rounded-pill fs-16 me-2"></i>
                                        Install
                                    </button>
                                @else
                                    @if (!$plugin->enabled)
                                        <button wire:click="enablePlugin('{{ $plugin->uuid }}')" type="button"
                                            class="btn btn-success btn-label waves-effect waves-light rounded-pill">
                                            <i class="ri-add-fill label-icon align-middle rounded-pill fs-16 me-2"></i>
                                            Enable
                                        </button>
                                    @else
                                        <button wire:click="disablePlugin('{{ $plugin->uuid }}')" type="button"
                                            class="btn btn-primary btn-label waves-effect waves-light rounded-pill">
                                            <i class="ri-error-warning-line label-icon align-middle rounded-pill fs-16 me-2"></i>
                                            Configure
                                        </button>
                                        <button wire:click="disablePlugin('{{ $plugin->uuid }}')" type="button"
                                            class="btn btn-info btn-label waves-effect waves-light rounded-pill">
                                            <i class="ri-file-pdf-line label-icon align-middle rounded-pill fs-16 me-2"></i>
                                            Docs
                                        </button>
                                        <button wire:click="disablePlugin('{{ $plugin->uuid }}')" type="button"
                                            class="btn btn-warning btn-label waves-effect waves-light rounded-pill">
                                            <i class="ri-error-warning-line label-icon align-middle rounded-pill fs-16 me-2"></i>
                                            Disable
                                        </button>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endisset
    </div>
    {{-- <div class="row g-0 justify-content-end mb-4" id="pagination-element">
        <!-- end col -->
        <div class="col-sm-6">
            <div
                class="pagination-block pagination pagination-separated justify-content-center justify-content-sm-end mb-sm-0">
                <div class="page-item">
                    <a href="javascript:void(0);" class="page-link" id="page-prev">Previous</a>
                </div>
                <span id="page-num" class="pagination"></span>
                <div class="page-item">
                    <a href="javascript:void(0);" class="page-link" id="page-next">Next</a>
                </div>
            </div>
        </div><!-- end col -->
    </div> --}}
    <!-- end row -->
</div>
