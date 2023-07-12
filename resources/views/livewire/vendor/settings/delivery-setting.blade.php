<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Delivery Settings</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 mb-3">
                            <div class="form-check form-switch form-switch-success form-switch-lg" dir="ltr">
                                <input type="checkbox" class="form-check-input" id="free_delivery">
                                <label class="form-check-label" for="free_delivery">Enable Free Delivery</label>
                            </div>
                            <p class="text-muted">Check this box to Free delivery charges for eligible orders.
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 mb-2">
                            <label class="form-label">Delivery Unit</label>
                            <input type="text" class="form-control @error('delivery_unit') is-invalid @enderror"
                                name="delivery_unit" value="{{ old('delivery_unit') ? old('delivery_unit') : '' }}"
                                id="delivery_unit" placeholder="Enter delivery unit e.g Kilometers, Miles">
                            <p class="text-muted">Select delivery unit for calculations.
                            </p>
                            @error('delivery_radius')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-6 mb-2">
                            <label class="form-label">Delivery Radius</label>
                            <input type="text" class="form-control @error('delivery_radius') is-invalid @enderror"
                                name="delivery_radius"
                                value="{{ old('delivery_radius') ? old('delivery_radius') : '' }}" id="delivery_radius"
                                placeholder="Enter delivery in Kilometers">
                            <p class="text-muted">Enter delivery radius for order delivery.
                            </p>
                            @error('delivery_radius')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-6 mb-2">
                            <label class="form-label">Delivery Charges</label>
                            <input type="text" class="form-control @error('delivery_charges') is-invalid @enderror"
                                name="delivery_charges"
                                value="{{ old('delivery_charges') ? old('delivery_charges') : '' }}"
                                id="delivery_charges" placeholder="Enter delivery in Kilometers">
                            <p class="text-muted">Set a flat fee or a tiered structure for delivery charges based on
                                distance or order value.
                            </p>
                            @error('delivery_charges')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-6 mb-2">
                            <label class="form-label">Additional Charges</label>
                            <input type="text" class="form-control @error('additional_charges') is-invalid @enderror"
                                name="additional_charges"
                                value="{{ old('additional_charges') ? old('additional_charges') : '' }}"
                                id="additional_charges"
                                placeholder="Enter additional charges for delivery orders (e.g., handling fees)">
                            <p class="text-muted">Allow the inclusion of additional charges for special
                                circumstances
                                such as peak hours or extra services.
                            </p>
                            @error('additional_charges')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
