<div>
    @include('plugins.alerts.alerts')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Restaurant Information</h5>
                </div>
                <form wire:submit.prevent="updateRestaurantInformation">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 mb-2">
                                <label class="form-label">Restaurant Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    wire:model.defer="name" id="name" placeholder="Enter name">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @if (!$errors->has('name'))
                                    <p class="text-muted">Enter the name of your restaurant</p>
                                @endif
                            </div>
                            <div class="col-lg-6 mb-2">
                                <label class="form-label">Email Address</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror"
                                    wire:model.defer="email" id="email" placeholder="Enter a valid email address">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @if (!$errors->has('email'))
                                    <p class="text-muted">Enter your restaurant email address</p>
                                @endif
                            </div>
                            <div class="col-lg-6 mb-2">
                                <label class="form-label">Phone Number</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                    wire:model.defer="phone" id="phone"
                                    placeholder="Enter your valid phone number">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @if (!$errors->has('phone'))
                                    <p class="text-muted">Enter your restaurant phone number for contact.</p>
                                @endif
                            </div>
                            <div class="col-lg-6 mb-2">
                                <label class="form-label">Address</label>
                                <input type="text" class="form-control @error('address') is-invalid @enderror"
                                    wire:model.defer="address" id="address" placeholder="Enter your business address">
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @if (!$errors->has('address'))
                                    <p class="text-muted">Provide restaurant full address.</p>
                                @endif
                            </div>
                            <div class="col-lg-6 mb-2">
                                <label class="form-label">Address II</label>
                                <input type="text" class="form-control @error('address_2') is-invalid @enderror"
                                    wire:model.defer="address_2" id="address_2"
                                    placeholder="Appartment, Building, Suite# or Floor#">
                                @error('address_2')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @if (!$errors->has('address_2'))
                                    <p class="text-muted">Provide additional information about the address (e.g., Floor#
                                        4, Suite# 50).</p>
                                @endif
                            </div>
                            <div class="col-lg-6 mb-2">
                                <label class="form-label">Country</label>
                                <input type="text" class="form-control @error('country') is-invalid @enderror"
                                    wire:model.defer="country" id="country" placeholder="Enter country name">
                                @error('country')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @if (!$errors->has('country'))
                                    <p class="text-muted">Enter the restaurant's country.</p>
                                @endif
                            </div>
                            <div class="col-lg-6 mb-2">
                                <label class="form-label">City</label>
                                <input type="text" class="form-control @error('city') is-invalid @enderror"
                                    wire:model.defer="city" id="city" placeholder="City name">
                                @error('city')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @if (!$errors->has('city'))
                                    <p class="text-muted">Enter the restaurant's city.</p>
                                @endif
                            </div>
                            <div class="col-lg-6 mb-2">
                                <label class="form-label">Latitude</label>
                                <input type="text" class="form-control @error('latitude') is-invalid @enderror"
                                    wire:model.defer="latitude" id="latitude" placeholder="Latitude eg. 3722323.12">
                                @error('latitude')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @if (!$errors->has('latitude'))
                                    <p class="text-muted">Enter the restaurant's latitude value.</p>
                                @endif
                            </div>
                            <div class="col-lg-6 mb-2">
                                <label class="form-label">Longitude</label>
                                <input type="text" class="form-control @error('longitude') is-invalid @enderror"
                                    wire:model.defer="longitude" id="longitude" placeholder="Longitude eg. 3722323.12">
                                @error('longitude')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @if (!$errors->has('longitude'))
                                    <p class="text-muted">Enter the restaurant's longitude value.</p>
                                @endif
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
