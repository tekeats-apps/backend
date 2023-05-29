<div class="tab-pane fade" id="custom-v-pills-ordering" role="tabpanel" aria-labelledby="custom-v-pills-ordering-tab">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Orders Setting</h5>
                </div>
                <div class="card-body">
                    <fieldset class="mt-3">
                        <h5> Order Types</h5>
                        <hr>
                        <div class="row">
                            <div class="col-lg-4 mb-3">
                                <div class="form-check form-switch form-switch-success form-switch-lg" dir="ltr">
                                    <input type="checkbox" class="form-check-input" id="dine_in" checked="">
                                    <label class="form-check-label" for="dine_in">Dine In</label>
                                </div>
                            </div>
                            <div class="col-lg-4 mb-3">
                                <div class="form-check form-switch form-switch-success form-switch-lg" dir="ltr">
                                    <input type="checkbox" class="form-check-input" id="pickup" checked="">
                                    <label class="form-check-label" for="pickup">Pickup</label>
                                </div>
                            </div>
                            <div class="col-lg-4 mb-3">
                                <div class="form-check form-switch form-switch-success form-switch-lg" dir="ltr">
                                    <input type="checkbox" class="form-check-input" id="delivery" checked="">
                                    <label class="form-check-label" for="delivery">Delivery</label>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="mt-3">
                        <h5> Payment Types</h5>
                        <hr>
                        <div class="row">
                            <div class="col-lg-4 mb-3">
                                <div class="form-check form-switch form-switch-success form-switch-lg" dir="ltr">
                                    <input type="checkbox" class="form-check-input" id="dine_in" checked="">
                                    <label class="form-check-label" for="dine_in">Cash on Delivery</label>
                                </div>
                            </div>
                            <div class="col-lg-4 mb-3">
                                <div class="form-check form-switch form-switch-success form-switch-lg" dir="ltr">
                                    <input type="checkbox" class="form-check-input" id="pickup" checked="">
                                    <label class="form-check-label" for="pickup">Stripe</label>
                                </div>
                            </div>
                            <div class="col-lg-4 mb-3">
                                <div class="form-check form-switch form-switch-success form-switch-lg" dir="ltr">
                                    <input type="checkbox" class="form-check-input" id="delivery" checked="">
                                    <label class="form-check-label" for="delivery">Paypal</label>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="mt-3">
                        <h5> Other Settings</h5>
                        <hr>
                        <div class="row">
                            <div class="col-lg-4 mb-3">
                                <div class="form-check form-switch form-switch-success form-switch-lg" dir="ltr">
                                    <input type="checkbox" class="form-check-input" id="orders_auto_accept" checked="">
                                    <label class="form-check-label" for="orders_auto_accept">Auto Accept Orders</label>
                                </div>
                            </div>
                            <div class="col-lg-4 mb-3">
                                <div class="form-check form-switch form-switch-success form-switch-lg" dir="ltr">
                                    <input type="checkbox" class="form-check-input" id="allow_specail_instructions" checked="">
                                    <label class="form-check-label" for="allow_specail_instructions">Special Instructions</label>
                                </div>
                            </div>
                            <div class="col-lg-4 mb-3">
                                <div class="form-check form-switch form-switch-success form-switch-lg" dir="ltr">
                                    <input type="checkbox" class="form-check-input" id="allow_order_discounts" checked="">
                                    <label class="form-check-label" for="allow_order_discounts">Order Discounts/Promotions</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-lg-6 mb-2">
                                <label class="form-label">Minimum Order Amount</label>
                                <input type="text" class="form-control @error('minimum_order') is-invalid @enderror"
                                    name="minimum_order" value="{{ old('minimum_order') ? old('minimum_order') : '' }}" id="minimum_order"
                                    placeholder="Enter the minimum amount to place order">
                                <p class="text-muted">Set the minimum order value required for customers to place an order.
                                </p>
                                @error('minimum_order')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-6 mb-2">
                                <label class="form-label">Order Preparation Time</label>
                                <input type="text" class="form-control @error('order_prepration_time') is-invalid @enderror"
                                    name="order_prepration_time" value="{{ old('order_prepration_time') ? old('order_prepration_time') : '' }}" id="order_prepration_time"
                                    placeholder="Enter the order prepration time e.g. 10-15 Minutes">
                                <p class="text-muted">Set the estimated time needed to prepare an order after it is received.
                                </p>
                                @error('order_prepration_time')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-6 mb-2">
                                <label class="form-label">Order Lead Time</label>
                                <input type="text" class="form-control @error('order_lead_time') is-invalid @enderror"
                                    name="order_lead_time" value="{{ old('order_lead_time') ? old('order_lead_time') : '' }}" id="order_lead_time"
                                    placeholder="Enter the order lead time e.g. 5 Days">
                                <p class="text-muted">Determine the minimum lead time required for customers to place an order in advance.
                                </p>
                                @error('order_lead_time')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-6 mb-2">
                                <label class="form-label">Order Cut-off Time</label>
                                <input type="text" class="form-control @error('order_cutt_of_time') is-invalid @enderror"
                                    name="order_cutt_of_time" value="{{ old('order_cutt_of_time') ? old('order_cutt_of_time') : '' }}" id="order_cutt_of_time"
                                    placeholder="Enter the order cutt off time e.g. 40 Minutes">
                                <p class="text-muted">Specify the time at which orders will no longer be accepted for the current day before closing restaurant.
                                </p>
                                @error('order_cutt_of_time')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>
</div>
