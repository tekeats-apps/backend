<div class="tab-pane fade" id="custom-v-pills-ordering" role="tabpanel"
    aria-labelledby="custom-v-pills-ordering-tab">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Restaurant Information</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-8 mb-2">
                            <label class="form-label">Restaurant Name</label>
                            <input type="text" class="form-control @error('restaurant_name') is-invalid @enderror"
                                name="restaurant_name"
                                value="{{ old('restaurant_name') ? old('restaurant_name') : tenant()->store_name }}"
                                id="restaurant_name" placeholder="Enter name">
                            <p class="text-muted">Enter the name of your restaurant
                            </p>
                            @error('restaurant_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-8 mb-2">
                            <label class="form-label">Email Address</label>
                            <input type="text" class="form-control @error('restaurant_email') is-invalid @enderror"
                                name="restaurant_email"
                                value="{{ old('restaurant_email') ? old('restaurant_email') : tenant()->email }}"
                                id="restaurant_email" placeholder="Enter a valid email address">
                            <p class="text-muted">Enter your restaurant email address
                            </p>
                            @error('restaurant_email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-8 mb-2">
                            <label class="form-label">Phone Number</label>
                            <input type="text" class="form-control @error('restaurant_phone') is-invalid @enderror"
                                name="restaurant_phone"
                                value="{{ old('restaurant_phone') ? old('restaurant_phone') : '' }}"
                                id="restaurant_phone" placeholder="Enter your valid phone number">
                            <p class="text-muted">Enter you restaurant phone number for contact.
                            </p>
                            @error('restaurant_phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-8 mb-2">
                            <label class="form-label">Address</label>
                            <input type="text" class="form-control @error('restaurant_address') is-invalid @enderror"
                                name="restaurant_address"
                                value="{{ old('restaurant_address') ? old('restaurant_address') : '' }}"
                                id="restaurant_address" placeholder="Enter your business address">
                            <p class="text-muted">Provide restaurant full address.
                            </p>
                            @error('restaurant_address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-8 mb-2">
                            <label class="form-label">Address II</label>
                            <input type="text"
                                class="form-control @error('restaurant_address_2') is-invalid @enderror"
                                name="restaurant_address_2"
                                value="{{ old('restaurant_address_2') ? old('restaurant_address_2') : '' }}"
                                id="restaurant_address_2" placeholder="Appartment, Building, Suite# or Floor#">
                            <p class="text-muted">Provide addiotional information about address eg. Floor# 4, Suite# 50.
                            </p>
                            @error('restaurant_address_2')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-8 mb-2">
                            <label class="form-label">Country</label>
                            <input type="text"
                                class="form-control @error('restaurant_country') is-invalid @enderror"
                                name="restaurant_country"
                                value="{{ old('restaurant_country') ? old('restaurant_country') : '' }}"
                                id="restaurant_country" placeholder="Enter country name">
                            <p class="text-muted">Enter restaunt address country.
                            </p>
                            @error('restaurant_country')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-8 mb-2">
                            <label class="form-label">City</label>
                            <input type="text"
                                class="form-control @error('restaurant_city') is-invalid @enderror"
                                name="restaurant_city"
                                value="{{ old('restaurant_city') ? old('restaurant_city') : '' }}"
                                id="restaurant_city" placeholder="City name">
                            <p class="text-muted">Enter your restaurnt address city.
                            </p>
                            @error('restaurant_city')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-5 mb-2">
                            <label class="form-label">Latitude</label>
                            <input type="text"
                                class="form-control @error('restaurant_latitude') is-invalid @enderror"
                                name="restaurant_latitude"
                                value="{{ old('restaurant_latitude') ? old('restaurant_latitude') : '' }}"
                                id="restaurant_latitude" placeholder="Latitude eg. 3722323.12">
                            <p class="text-muted">Enter your restaurnt latitude value.
                            </p>
                            @error('restaurant_latitude')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-5 mb-2">
                            <label class="form-label">Longitude</label>
                            <input type="text"
                                class="form-control @error('restaurant_longitude') is-invalid @enderror"
                                name="restaurant_longitude"
                                value="{{ old('restaurant_longitude') ? old('restaurant_longitude') : '' }}"
                                id="restaurant_longitude" placeholder="Longitude eg. 3722323.12">
                            <p class="text-muted">Enter your restaurnt longitude value.
                            </p>
                            @error('restaurant_longitude')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
