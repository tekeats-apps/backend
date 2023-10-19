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
                            <!-- Distance Unit -->
                            <div class="col-lg-6 mb-2">
                                <label class="form-label">Delivery Unit</label>
                                <select class="form-control @error('distance_unit') is-invalid @enderror"
                                    wire:model="distance_unit">
                                    @foreach ($this->getDeliveryUnitsProperty() as $unit)
                                        <option value="{{ $unit }}">{{ ucfirst($unit) }}</option>
                                    @endforeach
                                </select>
                                <p class="text-muted">Pick the unit to use for distance.</p>
                                @error('distance_unit')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-6 mb-2">
                                <label class="form-label">Delivery Charge Type</label>
                                <select
                                    class="form-control @error('delivery_charge_type') is-invalid @enderror"
                                    wire:model="delivery_charge_type">
                                    <!-- Add your delivery types here. I'm assuming you've already defined these in your enums -->
                                    @foreach ($this->deliveryTypes as $type)
                                        <option value="{{ $type }}">{{ ucfirst($type) }}</option>
                                    @endforeach
                                </select>
                                <p class="text-muted">Choose the type of delivery charge.</p>
                                @error('delivery_charge_type')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            @if ($delivery_charge_type == 'distance')
                            <!-- Distance-Based Radius -->
                            <div class="col-lg-6 mb-2">
                                <label class="form-label">Delivery Radius for Charge</label>
                                <input wire:model="distance_based_radius" type="number"
                                    class="form-control @error('distance_based_radius') is-invalid @enderror"
                                    id="distance_based_radius" placeholder="Enter radius for charge">
                                <p class="text-muted">Set a radius for charge-based delivery.</p>
                                @error('distance_based_radius')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            @endif
                            <!-- Flat Delivery Charge -->
                            <div class="col-lg-6 mb-2">
                                <label class="form-label">Delivery Charges</label>
                                <input wire:model="delivery_charges" type="number"
                                    class="form-control @error('delivery_charges') is-invalid @enderror"
                                    id="delivery_charges" placeholder="Enter flat delivery charge">
                                <p class="text-muted">Set a fee for delivery.</p>
                                @error('delivery_charges')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <!-- Free Delivery Checkbox -->
                            <div class="col-lg-12 mb-3">
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
                            <!-- Show these fields only when Free Delivery is enabled -->
                            @if ($free_delivery)
                                <!-- Free Delivery Charge Type -->
                                <div class="col-lg-6 mb-2">
                                    <label class="form-label">Free Delivery Charge Type</label>
                                    <select
                                        class="form-control @error('free_delivery_charge_type') is-invalid @enderror"
                                        wire:model="free_delivery_charge_type">
                                        <!-- Add your delivery types here. I'm assuming you've already defined these in your enums -->
                                        @foreach ($this->deliveryTypes as $type)
                                            <option value="{{ $type }}">{{ ucfirst($type) }}</option>
                                        @endforeach
                                    </select>
                                    <p class="text-muted">Choose the type of free delivery charge.</p>
                                    @error('free_delivery_charge_type')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                @if ($free_delivery_charge_type == 'distance')
                                    <!-- Free Delivery Radius -->
                                    <div class="col-lg-6 mb-2">
                                        <label class="form-label">Free Delivery Radius</label>
                                        <input wire:model="free_delivery_radius" type="number"
                                            class="form-control @error('free_delivery_radius') is-invalid @enderror"
                                            id="free_delivery_radius" placeholder="Enter free delivery radius">
                                        <p class="text-muted">Set a radius for free delivery.</p>
                                        @error('free_delivery_radius')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                @endif
                            @endif
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
