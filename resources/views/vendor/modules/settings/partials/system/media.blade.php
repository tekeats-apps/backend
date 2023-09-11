@push('css')
    @include('plugins.dropify.css')
@endpush
<div class="tab-pane fade" id="custom-v-pills-media" role="tabpanel" aria-labelledby="custom-v-pills-media-info-tab">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Manage Media</h5>
                </div>
                <form action="{{ route('vendor.settings.update.media') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 mt-3">
                                <h5 class="fs-14 mb-2">Logo</h5>
                                @if (isset($media) && !empty($media->logo))
                                    <input type="file" class="dropify @error('logo') is-invalid @enderror"
                                        data-max-file-size="1M" data-show-remove="true" name="logo"
                                        data-default-file={{ $media->logo }} data-record-id="{{ $media->id }}"
                                        data-table-field="logo" data-table-name="restaurant_media"
                                        data-image-path="{{ App\Models\Vendor\RestaurantMedia::IMAGE_PATH }}" />
                                @else
                                    <input type="file" class="dropify @error('logo') is-invalid @enderror"
                                        data-max-file-size="1M" data-show-remove="true" name="logo" />
                                @endif
                                @error('logo')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-6 mt-3">
                                <h5 class="fs-14 mb-2">Favicon</h5>
                                @if (isset($media) && !empty($media->favicon))
                                    <input type="file" class="dropify @error('favicon') is-invalid @enderror"
                                        data-max-file-size="1M" data-show-remove="true" data-max-width="32"
                                        data-max-height="32" name="favicon" data-default-file={{ $media->favicon }}
                                        data-record-id="{{ $media->id }}" data-table-field="favicon"
                                        data-table-name="restaurant_media"
                                        data-image-path="{{ App\Models\Vendor\RestaurantMedia::IMAGE_PATH }}" />
                                @else
                                    <input type="file" class="dropify @error('favicon') is-invalid @enderror"
                                        data-max-file-size="1M" data-show-remove="true" name="favicon" />
                                @endif
                                @error('favicon')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="text-end">
                            <button type="submit" class="btn btn-success -sm">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@push('script')
    @include('plugins.dropify.js')
    <script>
        drEvent.on('dropify.beforeClear', function(event, element) {
            return confirm("Do you really want to delete this file?");
        });
        drEvent.on('dropify.afterClear', function(event, element) {
            var recordId = $(this).data('record-id');
            var tableField = $(this).data('table-field');
            var tableName = $(this).data('table-name');
            var imagePath = $(this).data('image-path');
            removeImage(recordId, tableField, tableName, imagePath)
        });
    </script>
@endpush
