<div>
    @include('plugins.alerts.alerts')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Delivery Settings</h5>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="save">
                        <div class="row">
                            <div class="col-lg-6 mb-3">
                                <div class="form-check form-switch form-switch-success form-switch-lg" dir="ltr">
                                    <input wire:model="free_delivery" type="checkbox"
                                        class="form-check-input @error('free_delivery') is-invalid @enderror"
                                        id="free_delivery" value="1">
                                    <label class="form-check-label" for="free_delivery">Enable Free Delivery</label>
                                </div>
                                @error('free_delivery')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 mb-2">
                                <label class="form-label">Delivery Unit</label>
                                <select class="form-control @error('delivery_unit') is-invalid @enderror"
                                    wire:model.defer="delivery_unit">
                                    @foreach ($this->getDeliveryUnitsProperty() as $unit)
                                        <option value="{{ $unit }}">{{ ucfirst($unit) }}</option>
                                    @endforeach
                                </select>
                                <p class="text-muted">Select delivery unit for calculations.</p>
                                @error('delivery_unit')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-6 mb-2">
                                <label class="form-label">Delivery Radius</label>
                                <input wire:model.defer="delivery_radius" type="text"
                                    class="form-control @error('delivery_radius') is-invalid @enderror"
                                    id="delivery_radius" placeholder="Enter delivery in Kilometers">
                                <p class="text-muted">Enter delivery radius for order delivery.</p>
                                @error('delivery_radius')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-6 mb-2">
                                <label class="form-label">Delivery Charges</label>
                                <input wire:model.defer="delivery_charges" type="text"
                                    class="form-control @error('delivery_charges') is-invalid @enderror"
                                    id="delivery_charges" placeholder="Enter delivery charges">
                                <p class="text-muted">Set a flat fee or a tiered structure for delivery charges based on
                                    distance or order value.</p>
                                @error('delivery_charges')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-6 mb-2">
                                <label class="form-label">Additional Charges</label>
                                <input wire:model.defer="additional_charges" type="text"
                                    class="form-control @error('additional_charges') is-invalid @enderror"
                                    id="additional_charges"
                                    placeholder="Enter additional charges for delivery orders (e.g., handling fees)">
                                <p class="text-muted">Allow the inclusion of additional charges for special
                                    circumstances such as peak hours or extra services.</p>
                                @error('additional_charges')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
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
</div>
