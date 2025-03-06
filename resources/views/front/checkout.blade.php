<x-app-layout>
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-8">
                <!-- Progress Steps -->
                <div class="mb-5">
                    <div class="position-relative m-4">
                        <div class="progress" style="height: 3px;">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="position-absolute top-0 start-0 translate-middle">
                            <button class="btn btn-primary btn-sm rounded-pill px-3" disabled>1. Shipping</button>
                        </div>
                        <div class="position-absolute top-0 start-50 translate-middle">
                            <button class="btn btn-secondary btn-sm rounded-pill px-3" disabled>2. Payment</button>
                        </div>
                        <div class="position-absolute top-0 start-100 translate-middle">
                            <button class="btn btn-secondary btn-sm rounded-pill px-3" disabled>3. Review</button>
                        </div>
                    </div>
                </div>

                <!-- Shipping Information Form -->
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-body p-4">
                        <h4 class="mb-4">Shipping Information</h4>
                        <form wire:submit.prevent="saveShipping">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Full Name</label>
                                    <input type="text" class="form-control" wire:model="shipping.name" required>
                                    @error('shipping.name') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Phone Number</label>
                                    <input type="tel" class="form-control" wire:model="shipping.phone" required>
                                    @error('shipping.phone') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Address</label>
                                    <textarea class="form-control" rows="3" wire:model="shipping.address" required></textarea>
                                    @error('shipping.address') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">City</label>
                                    <input type="text" class="form-control" wire:model="shipping.city" required>
                                    @error('shipping.city') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Postal Code</label>
                                    <input type="text" class="form-control" wire:model="shipping.postal_code" required>
                                    @error('shipping.postal_code') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Notes (Optional)</label>
                                    <textarea class="form-control" rows="2" wire:model="shipping.notes"></textarea>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Payment Methods -->
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">
                        <h4 class="mb-4">Payment Method</h4>
                        <div class="list-group">
                            <label class="list-group-item d-flex gap-3">
                                <input class="form-check-input" type="radio" name="payment_method" value="bank_transfer" wire:model="paymentMethod">
                                <span>
                                    <i class="bi bi-bank me-2"></i>
                                    Bank Transfer
                                    <small class="d-block text-muted">Transfer to our bank account</small>
                                </span>
                            </label>
                            <label class="list-group-item d-flex gap-3">
                                <input class="form-check-input" type="radio" name="payment_method" value="e_wallet" wire:model="paymentMethod">
                                <span>
                                    <i class="bi bi-wallet2 me-2"></i>
                                    E-Wallet
                                    <small class="d-block text-muted">Pay with your e-wallet</small>
                                </span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="col-lg-4">
                <div class="card shadow-sm border-0 position-sticky" style="top: 2rem;">
                    <div class="card-body p-4">
                        <h4 class="mb-4">Order Summary</h4>
                        @foreach($cartItems as $item)
                            <div class="d-flex gap-3 mb-3">
                                <img src="{{ asset('storage/' . $item->product->image) }}"
                                     alt="{{ $item->product->name }}"
                                     class="rounded"
                                     style="width: 64px; height: 64px; object-fit: cover;">
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">{{ $item->product->name }}</h6>
                                    <p class="text-muted small mb-0">Qty: {{ $item->quantity }}</p>
                                    <span class="text-primary">
                                        Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                        @endforeach

                        <hr>

                        <div class="mb-2 d-flex justify-content-between">
                            <span class="text-muted">Subtotal</span>
                            <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                        </div>
                        <div class="mb-2 d-flex justify-content-between">
                            <span class="text-muted">Shipping</span>
                            <span>Rp {{ number_format($shipping, 0, ',', '.') }}</span>
                        </div>
                        <hr>
                        <div class="mb-4 d-flex justify-content-between fw-bold">
                            <span>Total</span>
                            <span class="text-primary">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>

                        <button class="btn btn-primary w-100" wire:click="placeOrder">
                            Place Order
                            <i class="bi bi-arrow-right ms-2"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
