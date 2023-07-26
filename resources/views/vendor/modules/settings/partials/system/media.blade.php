<div class="tab-pane fade" id="custom-v-pills-media" role="tabpanel" aria-labelledby="custom-v-pills-media-info-tab">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Manage Media</h5>
                </div>
                <form>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 mt-3">
                                <h5 class="fs-14 mb-2">Logo</h5>
                                <input type="file" class="dropify @error('logo') is-invalid @enderror"
                                    data-max-file-size="1M" data-show-remove="false" name="logo" />

                                @error('logo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-6 mt-3">
                                <h5 class="fs-14 mb-2">Fav Icon</h5>
                                <input type="file" class="dropify @error('fav_icon') is-invalid @enderror"
                                    data-max-file-size="1M" data-show-remove="false" name="fav_icon" />

                                @error('fav_icon')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-6 mt-5">
                                <h5 class="fs-14 mb-2">Admin Logo</h5>
                                <input type="file" class="dropify @error('admin_logo') is-invalid @enderror"
                                    data-max-file-size="1M" data-show-remove="false" name="admin_logo" />

                                @error('admin_logo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-6 mt-5">
                                <h5 class="fs-14 mb-2">Admin Fav Icon</h5>
                                <input type="file" class="dropify @error('admin_fav_icon') is-invalid @enderror"
                                    data-max-file-size="1M" data-show-remove="false" name="admin_fav_icon" />

                                @error('admin_fav_icon')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="text-end">
                            <button type="submit" class="btn btn-success w-sm">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
