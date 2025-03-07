<x-app-layout>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Progress Steps -->
                <div class="mb-5">
                    <div class="position-relative m-4">
                        <div class="progress" style="height: 3px;">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 100%"></div>
                        </div>
                        <div class="position-absolute top-0 start-0 translate-middle">
                            <button class="btn btn-success btn-sm rounded-pill px-3" disabled>1. Shipping</button>
                        </div>
                        <div class="position-absolute top-0 start-50 translate-middle">
                            <button class="btn btn-success btn-sm rounded-pill px-3" disabled>2. Payment</button>
                        </div>
                        <div class="position-absolute top-0 start-100 translate-middle">
                            <button class="btn btn-primary btn-sm rounded-pill px-3" disabled>3. Confirmation</button>
                        </div>
                    </div>
                </div>

                <!-- Order Summary Card -->
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white py-3">
                        <h5 class="card-title mb-0">Order #{{ $order->order_number }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            <span class="text-muted">Subtotal</span>
                            <span>Rp {{ number_format($order->subtotal, 0, ',', '.') }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span class="text-muted">Shipping</span>
                            <span>Rp {{ number_format($order->shipping_fee, 0, ',', '.') }}</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-0">
                            <strong>Total</strong>
                            <strong class="text-primary">Rp {{ number_format($order->total_price, 0, ',', '.') }}</strong>
                        </div>
                    </div>
                </div>

                <!-- Payment Methods -->
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white py-3">
                        <h5 class="card-title mb-0">Select Payment Method</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('payment.process', $order) }}" method="POST" id="paymentForm">
                            @csrf
                            <div class="list-group mb-4">
                                <!-- Bank Transfer Option -->
                                <label class="list-group-item d-flex gap-3">
                                    <input class="form-check-input" type="radio" name="payment_method"
                                           value="bank_transfer" checked>
                                    <span>
                                        <i class="bi bi-bank me-2"></i>
                                        Bank Transfer
                                        <small class="d-block text-muted">
                                            Transfer to our bank account
                                        </small>
                                    </span>
                                </label>

                                <!-- E-Wallet Option -->
                                <label class="list-group-item d-flex gap-3">
                                    <input class="form-check-input" type="radio" name="payment_method"
                                           value="e_wallet">
                                    <span>
                                        <i class="bi bi-wallet2 me-2"></i>
                                        E-Wallet
                                        <small class="d-block text-muted">
                                            Pay with your e-wallet
                                        </small>
                                    </span>
                                </label>
                            </div>

                            <!-- Bank Account Details (Initially Hidden) -->
                            <div id="bankDetails" class="card bg-light border-0 mb-4">
                                <div class="card-body">
                                    <h6 class="card-title">Bank Account Details</h6>
                                    <p class="mb-1"><strong>Bank:</strong> Bank Central Asia (BCA)</p>
                                    <p class="mb-1"><strong>Account Number:</strong> 1234567890</p>
                                    <p class="mb-1"><strong>Account Name:</strong> PT Mistify Indonesia</p>
                                    <div class="alert alert-warning mt-3 mb-0">
                                        <i class="bi bi-exclamation-triangle me-2"></i>
                                        Please complete your payment within 24 hours
                                    </div>
                                </div>
                            </div>

                            <!-- E-Wallet Instructions (Initially Hidden) -->
                            <div id="walletDetails" class="card bg-light border-0 mb-4" style="display: none;">
                                <div class="card-body">
                                    <h6 class="card-title">E-Wallet Payment</h6>
                                    <p class="mb-1">Scan the QR code below to complete your payment:</p>
                                    <div class="text-center my-3">
                                        <img src="{{ asset('images/qr-code.png') }}" alt="QR Code"
                                             style="width: 200px; height: 200px;">
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">
                                Confirm Payment
                                <i class="bi bi-arrow-right ms-2"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const bankDetails = document.getElementById('bankDetails');
            const walletDetails = document.getElementById('walletDetails');
            const paymentMethods = document.getElementsByName('payment_method');

            paymentMethods.forEach(method => {
                method.addEventListener('change', function() {
                    if (this.value === 'bank_transfer') {
                        bankDetails.style.display = 'block';
                        walletDetails.style.display = 'none';
                    } else {
                        bankDetails.style.display = 'none';
                        walletDetails.style.display = 'block';
                    }
                });
            });
        });
    </script>
    @endpush
</x-app-layout>
