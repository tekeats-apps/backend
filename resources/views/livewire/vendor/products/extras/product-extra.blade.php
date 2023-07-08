<div>
    <div wire:ignore.self id="extrasModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel"
        aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">{{ $extraId ? 'Update' : 'Create' }} New Product Extras
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        wire:click="resetInputFields()"> </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 mb-2">
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    placeholder="Enter extras name like Chocolate Topping, Sauce"
                                    wire:model.defer="name">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-12 mb-2">
                            <div class="mb-3">
                                <label class="form-label">Price</label>
                                <input type="number" min="0" step="0.01"
                                    class="form-control @error('price') is-invalid @enderror"
                                    placeholder="Enter extras price like 20" wire:model.defer="price">
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal"
                        wire:click="resetInputFields()">Close</button>
                    <button type="button" class="btn btn-primary" wire:click.prevent="store()">Save Changes</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>
@push('script')
    <script>
        window.livewire.on('closeExtrasModal', () => {
            var myModal = bootstrap.Modal.getInstance(document.getElementById('extrasModal'));
            myModal.hide();
        });
        window.livewire.on('openExtrasModal', () => {
            var myModal = bootstrap.Modal.getInstance(document.getElementById('extrasModal'));
            myModal.show();
        });
    </script>
@endpush
