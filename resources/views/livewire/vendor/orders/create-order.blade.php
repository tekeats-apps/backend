<div>
    <form id="order-form" method="POST" autocomplete="off" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Order Information</h5>
                    </div>
                    <div class="card-body">
                        <!-- Product Selection -->
                        <div class="mb-3">
                            <label for="product-selection" class="form-label">Select Product</label>
                            <select class="form-control" id="product-selection" wire:model="selectedProduct">
                                <option value="">--Select Product--</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product['id'] }}">{{ $product['name'] }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Add to Order Button -->
                        <button type="button" class="btn btn-primary float-right" wire:click="addProductToOrder()">Add
                            to Cart</button>

                        <!-- Dynamically generated product cards -->
                        <div id="product-cards" class="mt-4">
                            @foreach ($selectedProducts as $index => $product)
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $product['name'] }}</h5>
                                        <p class="card-text">Price: ${{ number_format($product['price'], 2) }}</p>

                                        <!-- Variant Selection -->
                                        <div class="mb-3">
                                            <label for="variant-selection-{{ $index }}" class="form-label">Select
                                                Variant (Optional)</label>
                                            <select class="form-control" id="variant-selection-{{ $index }}"
                                                wire:change="updateProductVariant({{ $index }}, $event.target.value)">
                                                <!-- Populate this dropdown with variants from your database -->
                                                <option value="">--Select Variant--</option>
                                                @foreach ($variants as $variant)
                                                    <option value="{{ $variant['id'] }}"
                                                        {{ $product['variant'] == $variant['id'] ? 'selected' : '' }}>
                                                        {{ $variant['name'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <!-- Extras Selection -->
                                        <div class="mb-3">
                                            <label for="extras-selection-{{ $index }}" class="form-label">Select
                                                Extras (Optional)</label>
                                            <select class="form-control" id="extras-selection-{{ $index }}"
                                                wire:change="updateProductExtras({{ $index }}, $event.target.value)">
                                                <!-- Populate this dropdown with extras from your database -->
                                                <option value="">--Select Extras--</option>
                                                @foreach ($extras as $extra)
                                                    <option value="{{ $extra['id'] }}"
                                                        {{ $product['extras'] == $extra['id'] ? 'selected' : '' }}>
                                                        {{ $extra['name'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- Quantity -->
                                        <div class="mb-3">
                                            <label for="product-quantity-{{ $index }}"
                                                class="form-label">Quantity</label>
                                            <input type="number" class="form-control" min="1"
                                                id="product-quantity-{{ $index }}"
                                                wire:change="updateProductQuantity({{ $index }}, $event.target.value)"
                                                value="{{ $product['quantity'] }}">
                                        </div>

                                        <!-- Remove from Cart Button -->
                                        <button type="button" class="btn btn-danger"
                                            wire:click="removeProductFromOrder({{ $index }})">Remove</button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Order Summary</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive table-card">
                            <table class="table table-borderless align-middle mb-0">
                                <thead class="table-light text-muted">
                                    <tr>
                                        <th style="width: 90px;" scope="col">Product</th>
                                        <th scope="col">Product Info</th>
                                        <th scope="col" class="text-end">Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($selectedProducts as $product)
                                        <tr>
                                            <td>
                                                <div class="avatar-md bg-light rounded p-1">
                                                    <!-- You can dynamically load product images here -->
                                                    <img src="{{ URL::asset('build/images/products/img-placeholder.png') }}"
                                                        alt="" class="img-fluid d-block">
                                                </div>
                                            </td>
                                            <td>
                                                <h5 class="fs-14">{{ $product['name'] }}</h5>
                                                <p class="text-muted mb-0">${{ number_format($product['price'], 2) }} x
                                                    {{ $product['quantity'] }}</p>
                                                @if ($product['variant'])
                                                    <p class="text-muted mb-0">
                                                        Variant:
                                                        {{ collect($variants)->firstWhere('id', $product['variant'])['name'] }}
                                                        -
                                                        ${{ number_format(collect($variants)->firstWhere('id', $product['variant'])['price'], 2) }}
                                                    </p>
                                                @endif
                                                @if ($product['extras'])
                                                    <p class="text-muted mb-0">
                                                        Extras:
                                                        {{ collect($extras)->firstWhere('id', $product['extras'])['name'] }}
                                                        -
                                                        ${{ number_format(collect($extras)->firstWhere('id', $product['extras'])['price'], 2) }}
                                                    </p>
                                                @endif
                                            </td>
                                            <td class="text-end">
                                                ${{ number_format($product['subtotal'], 2) }}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td class="fw-semibold" colspan="2">Sub Total :</td>
                                        <td class="fw-semibold text-end">${{ number_format($subtotal, 2) }}</td>
                                    </tr>
                                    <tr class="table-active">
                                        <th colspan="2">Total (USD) :</th>
                                        <td class="text-end">
                                            <span class="fw-semibold">
                                                ${{ number_format($total, 2) }}
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
