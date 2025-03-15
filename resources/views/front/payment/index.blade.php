<x-app-layout>
    <!-- ...existing header and progress steps... -->

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- ...existing alerts and order summary... -->

                <!-- Payment Methods -->
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white py-3">
                        <h5 class="card-title mb-0">Select Payment Method</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('payment.process', $order->order_number) }}" method="POST" id="paymentForm">
                            @csrf
                            <div class="list-group mb-4">
                                <!-- Bank Transfer Option -->
                                <label class="list-group-item d-flex gap-3">
                                    <input class="form-check-input" type="radio" name="payment_method"
                                           value="bank_transfer" required checked>
                                    <span>
                                        <i class="bi bi-bank me-2"></i>
                                        Manual Bank Transfer
                                        <small class="d-block text-muted">
                                            Transfer manually to our bank account
                                        </small>
                                    </span>
                                </label>

                                <!-- E-Wallet & Virtual Account Option -->
                                <label class="list-group-item d-flex gap-3">
                                    <input class="form-check-input" type="radio" name="payment_method"
                                           value="e_wallet" required>
                                    <span>
                                        <i class="bi bi-wallet2 me-2"></i>
                                        E-Wallet & Virtual Account
                                        <small class="d-block text-muted">
                                            GoPay, ShopeePay, QRIS, Virtual Account (BCA, BNI, BRI, Mandiri)
                                        </small>
                                    </span>
                                </label>
                            </div>

                            <!-- Manual Bank Transfer Details -->
                            <div id="bankDetails" class="card bg-light border-0 mb-4">
                                <div class="card-body">
                                    <h6 class="card-title mb-3">Bank Account Details</h6>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <p class="mb-1"><strong>Bank Name</strong></p>
                                            <p class="mb-0">Bank Central Asia (BCA)</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="mb-1"><strong>Account Number</strong></p>
                                            <p class="mb-0 font-monospace">1234567890</p>
                                        </div>
                                        <div class="col-12">
                                            <p class="mb-1"><strong>Account Name</strong></p>
                                            <p class="mb-0">PT Mistify Indonesia</p>
                                        </div>
                                        <div class="col-12">
                                            <p class="mb-1"><strong>Transfer Amount</strong></p>
                                            <p class="mb-0 text-primary fw-bold">
                                                Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="alert alert-warning mt-3 mb-0">
                                        <div class="d-flex gap-2">
                                            <i class="bi bi-exclamation-triangle"></i>
                                            <div>
                                                <strong>Important:</strong>
                                                <p class="mb-0">Please complete your payment within 24 hours to avoid order cancellation.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- E-Wallet & Virtual Account Details -->
                            <div id="walletDetails" class="card bg-light border-0 mb-4" style="display: none;">
                                <div class="card-body text-center">
                                    <h6 class="card-title mb-3">Online Payment</h6>
                                    <p class="mb-3">You will be redirected to our payment gateway to complete your payment.</p>
                                    <div class="row g-3 justify-content-center mb-4">
                                        <div class="col-auto">
                                            <img src="{{ asset('images/payment/gopay.png') }}" alt="GoPay" height="30">
                                        </div>
                                        <div class="col-auto">
                                            <img src="{{ asset('images/payment/shopeepay.png') }}" alt="ShopeePay" height="30">
                                        </div>
                                        <div class="col-auto">
                                            <img src="{{ asset('images/payment/qris.png') }}" alt="QRIS" height="30">
                                        </div>
                                    </div>
                                    <div class="alert alert-info mb-0">
                                        <div class="d-flex gap-2">
                                            <i class="bi bi-info-circle"></i>
                                            <div>
                                                <strong>Note:</strong>
                                                <p class="mb-0">You can also pay using Virtual Account from various banks.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary w-100" id="submitBtn">
                                <span class="spinner-border spinner-border-sm d-none me-2" role="status"></span>
                                Continue to Payment
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
            const form = document.getElementById('paymentForm');
            const submitBtn = document.getElementById('submitBtn');
            const spinner = submitBtn.querySelector('.spinner-border');
            const bankDetails = document.getElementById('bankDetails');
            const walletDetails = document.getElementById('walletDetails');
            const paymentMethods = document.getElementsByName('payment_method');

            // Handle payment method change
            paymentMethods.forEach(method => {
                method.addEventListener('change', function() {
                    if (this.value === 'bank_transfer') {
                        bankDetails.style.display = 'block';
                        walletDetails.style.display = 'none';
                        submitBtn.textContent = 'Confirm Payment';
                    } else {
                        bankDetails.style.display = 'none';
                        walletDetails.style.display = 'block';
                        submitBtn.textContent = 'Continue to Payment Gateway';
                    }
                });
            });

            // Handle form submission
            form.addEventListener('submit', function() {
                submitBtn.disabled = true;
                spinner.classList.remove('d-none');
                submitBtn.querySelector('.bi-arrow-right').classList.add('d-none');
            });
        });
    </script>
    @endpush
</x-app-layout>
