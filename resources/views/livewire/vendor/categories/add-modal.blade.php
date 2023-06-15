<div  wire:ignore.self class="modal fade" id="categoryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light p-3">
                <h5 class="modal-title" id="exampleModalLabel">Category Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    id="close-modal"></button>
            </div>
            <form wire:submit.prevent="saveCategory()">
                <div class="modal-body">
                    <input type="hidden" wire:model="categoryId" />
                    <div class="mb-3">
                        <label for="category-name" class="form-label">Category Name</label>
                        <input type="text" wire:model="name" id="category-name"
                            class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                            placeholder="Enter category name" />
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="status-field" class="form-label">Position</label>
                        <select class="form-control {{ $errors->has('position') ? ' is-invalid' : '' }}"
                            wire:model="position" id="status-field">
                            <option value="">Select Position</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                        @error('position')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea5" class="form-label">Description</label>
                        <textarea class="form-control {{ $errors->has('description') ? ' is-invalid' : '' }}" wire:model="description"
                            id="exampleFormControlTextarea5" rows="3"></textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="category-image" class="form-label">Image</label>
                        <input type="file" wire:model="image" id="category-image"
                            class="form-control {{ $errors->has('image') ? ' is-invalid' : '' }}" />
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <div class="form-check form-switch form-switch-lg form-switch-info">
                            <input class="form-check-input {{ $errors->has('featured') ? ' is-invalid' : '' }}"
                                type="checkbox" wire:model="featured" id="SwitchCheck11">
                            <label class="form-check-label" for="SwitchCheck11">Featured</label>
                        </div>
                        @error('featured')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <div class="form-check form-switch form-switch-lg form-switch-success">
                            <input class="form-check-input {{ $errors->has('status') ? ' is-invalid' : '' }}"
                                type="checkbox" wire:model="status" id="SwitchCheck12">
                            <label class="form-check-label" for="SwitchCheck12">Active</label>
                        </div>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="hstack gap-2 justify-content-end">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success"
                            id="add-btn">{{ $categoryId ? 'Update' : 'Submit' }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
