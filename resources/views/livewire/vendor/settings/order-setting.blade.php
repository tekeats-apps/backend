<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Orders Setting</h5>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="save">
                        <fieldset class="mt-3">
                            <h5> Order Types</h5>
                            <hr>
                            <div class="row">
                                <div class="col-lg-4 mb-3">
                                    <div class="form-check form-switch form-switch-success form-switch-lg"
                                        dir="ltr">
                                        <input type="checkbox" wire:model.defer="dine_in" class="form-check-input"
                                            id="dine_in">
                                        <label class="form-check-label" for="dine_in">Dine In</label>
                                    </div>
                                    @error('dine_in')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-4 mb-3">
                                    <div class="form-check form-switch form-switch-success form-switch-lg"
                                        dir="ltr">
                                        <input type="checkbox" wire:model.defer="pickup" class="form-check-input"
                                            id="pickup">
                                        <label class="form-check-label" for="pickup">Pickup</label>
                                    </div>
                                    @error('pickup')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-4 mb-3">
                                    <div class="form-check form-switch form-switch-success form-switch-lg"
                                        dir="ltr">
                                        <input type="checkbox" wire:model.defer="delivery" class="form-check-input"
                                            id="delivery">
                                        <label class="form-check-label" for="delivery">Delivery</label>
                                    </div>
                                    @error('delivery')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </fieldset>
                        <fieldset class="mt-3">
                            <h5> Payment Types</h5>
                            <hr>
                            <div class="row">
                                <div class="col-lg-4 mb-3">
                                    <div class="form-check form-switch form-switch-success form-switch-lg"
                                        dir="ltr">
                                        <input type="checkbox" wire:model.defer="cash_on_delivery" class="form-check-input"
                                            id="cash_on_delivery">
                                        <label class="form-check-label" for="cash_on_delivery">Cash on Delivery</label>
                                    </div>
                                    @error('cash_on_delivery')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-4 mb-3">
                                    <div class="form-check form-switch form-switch-success form-switch-lg"
                                        dir="ltr">
                                        <input type="checkbox" wire:model.defer="stripe" class="form-check-input"
                                            id="stripe">
                                        <label class="form-check-label" for="stripe">Stripe</label>
                                    </div>
                                    @error('stripe')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-4 mb-3">
                                    <div class="form-check form-switch form-switch-success form-switch-lg"
                                        dir="ltr">
                                        <input type="checkbox" wire:model.defer="paypal" class="form-check-input"
                                            id="paypal">
                                        <label class="form-check-label" for="paypal">Paypal</label>
                                    </div>
                                    @error('paypal')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </fieldset>
                        <fieldset class="mt-3">
                            <h5> Other Settings</h5>
                            <hr>
                            <div class="row">
                                <div class="col-lg-4 mb-3">
                                    <div class="form-check form-switch form-switch-success form-switch-lg"
                                        dir="ltr">
                                        <input type="checkbox" wire:model.defer="orders_auto_accept" class="form-check-input"
                                            id="orders_auto_accept">
                                        <label class="form-check-label" for="orders_auto_accept">Auto Accept
                                            Orders</label>
                                    </div>
                                    @error('orders_auto_accept')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-4 mb-3">
                                    <div class="form-check form-switch form-switch-success form-switch-lg"
                                        dir="ltr">
                                        <input type="checkbox" wire:model.defer="allow_special_instructions"
                                            class="form-check-input" id="allow_special_instructions">
                                        <label class="form-check-label" for="allow_special_instructions">Special
                                            Instructions</label>
                                    </div>
                                    @error('allow_special_instructions')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-4 mb-3">
                                    <div class="form-check form-switch form-switch-success form-switch-lg"
                                        dir="ltr">
                                        <input type="checkbox" wire:model.defer="allow_order_discounts"
                                            class="form-check-input" id="allow_order_discounts">
                                        <label class="form-check-label" for="allow_order_discounts">Order
                                            Discounts/Promotions</label>
                                    </div>
                                    @error('allow_order_discounts')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-lg-6 mb-2">
                                    <label class="form-label">Minimum Order Amount</label>
                                    <input type="text" wire:model.defer="minimum_order"
                                        class="form-control @error('minimum_order') is-invalid @enderror"
                                        name="minimum_order" id="minimum_order"
                                        placeholder="Enter the minimum amount to place order">
                                    @error('minimum_order')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <label class="form-label">Order Preparation Time</label>
                                    <input type="text" wire:model.defer="order_preparation_time"
                                        class="form-control @error('order_preparation_time') is-invalid @enderror"
                                        name="order_preparation_time" id="order_preparation_time"
                                        placeholder="Enter the order preparation time e.g. 10-15 Minutes">
                                    @error('order_preparation_time')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <label class="form-label">Order Lead Time</label>
                                    <input type="text" wire:model.defer="order_lead_time"
                                        class="form-control @error('order_lead_time') is-invalid @enderror"
                                        name="order_lead_time" id="order_lead_time"
                                        placeholder="Enter the order lead time e.g. 5 Days">
                                    @error('order_lead_time')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <label class="form-label">Order Cut-off Time</label>
                                    <input type="text" wire:model.defer="order_cutoff_time"
                                        class="form-control @error('order_cutoff_time') is-invalid @enderror"
                                        name="order_cutoff_time" id="order_cutoff_time"
                                        placeholder="Enter the order cutoff time e.g. 40 Minutes">
                                    @error('order_cutoff_time')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </fieldset>
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
