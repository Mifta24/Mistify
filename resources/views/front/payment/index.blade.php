<x-app-layout>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6">

            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body p-5">

                    <h4 class="mb-2 fw-semibold">Pilih Metode Pembayaran</h4>
                    <p class="text-muted mb-4">Lengkapi transaksi Anda dengan memilih metode pembayaran yang diinginkan.</p>

                    <form action="{{ route('payment.process', $order->order_number) }}" method="POST" id="paymentForm">
                        @csrf

                        <div class="d-grid gap-3 mb-4">
                            <!-- Bank Transfer -->
                            <label class="payment-method card p-4 border border-light-subtle rounded-4 shadow-sm transition position-relative">
                                <input type="radio" name="payment_method" value="bank_transfer" class="position-absolute top-0 end-0 m-3 form-check-input" checked required>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="icon bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center" style="width:48px;height:48px;">
                                        <i class="bi bi-bank fs-4"></i>
                                    </div>
                                    <div>
                                        <div class="fw-semibold">Transfer Bank Manual</div>
                                        <div class="text-muted small">Transfer secara manual ke rekening kami.</div>
                                    </div>
                                </div>
                            </label>

                            <!-- E-Wallet -->
                            <label class="payment-method card p-4 border border-light-subtle rounded-4 shadow-sm transition position-relative">
                                <input type="radio" name="payment_method" value="e_wallet" class="position-absolute top-0 end-0 m-3 form-check-input" required>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="icon bg-success bg-opacity-10 text-success rounded-circle d-flex align-items-center justify-content-center" style="width:48px;height:48px;">
                                        <i class="bi bi-wallet2 fs-4"></i>
                                    </div>
                                    <div>
                                        <div class="fw-semibold">E-Wallet & Virtual Account</div>
                                        <div class="text-muted small">Bayar pakai GoPay, ShopeePay, QRIS, atau VA.</div>
                                    </div>
                                </div>
                            </label>
                        </div>

                        <!-- Transfer Details -->
                        <div id="bankDetails" class="bg-body-tertiary p-4 rounded-4 mb-4 fade show">
                            <h6 class="fw-semibold mb-3">Informasi Rekening</h6>
                            <div class="mb-2 small"><strong>Bank:</strong> Bank Central Asia (BCA)</div>
                            <div class="mb-2 small"><strong>No Rekening:</strong> <span class="font-monospace">1234567890</span></div>
                            <div class="mb-2 small"><strong>Atas Nama:</strong> PT Mistify Indonesia</div>
                            <div class="mb-2 small"><strong>Total Transfer:</strong> <span class="text-primary fw-bold">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span></div>

                            <div class="alert alert-warning d-flex align-items-center gap-2 mt-3 mb-0">
                                <i class="bi bi-exclamation-triangle-fill fs-5"></i>
                                <div class="small">
                                    Selesaikan pembayaran dalam 24 jam untuk menghindari pembatalan pesanan.
                                </div>
                            </div>
                        </div>

                        <!-- E-Wallet Details -->
                        <div id="walletDetails" class="bg-body-tertiary p-4 rounded-4 mb-4 d-none fade show text-center">
                            <h6 class="fw-semibold mb-3">Pembayaran Otomatis</h6>
                            <p class="text-muted small">Anda akan diarahkan ke payment gateway kami.</p>
                            <div class="d-flex justify-content-center gap-3 mb-3">
                                <img src="{{ asset('images/payment/gopay.png') }}" alt="GoPay" height="32">
                                <img src="{{ asset('images/payment/shopeepay.png') }}" alt="ShopeePay" height="32">
                                <img src="{{ asset('images/payment/qris.png') }}" alt="QRIS" height="32">
                            </div>
                            <div class="alert alert-info d-flex align-items-center gap-2 small mb-0">
                                <i class="bi bi-info-circle-fill fs-5"></i>
                                <div>
                                    Bisa juga bayar via VA (BCA, BNI, Mandiri, dll).
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 d-flex justify-content-center align-items-center gap-2" id="submitBtn">
                            <span class="spinner-border spinner-border-sm d-none" role="status"></span>
                            <span class="btn-text">Lanjut ke Pembayaran</span>
                            <i class="bi bi-arrow-right-circle"></i>
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('paymentForm');
        const submitBtn = document.getElementById('submitBtn');
        const spinner = submitBtn.querySelector('.spinner-border');
        const btnText = submitBtn.querySelector('.btn-text');
        const bankDetails = document.getElementById('bankDetails');
        const walletDetails = document.getElementById('walletDetails');
        const paymentOptions = document.querySelectorAll('input[name="payment_method"]');

        function toggleDetails() {
            const selected = document.querySelector('input[name="payment_method"]:checked').value;
            if (selected === 'bank_transfer') {
                bankDetails.classList.remove('d-none');
                walletDetails.classList.add('d-none');
                btnText.textContent = 'Konfirmasi Pembayaran';
            } else {
                bankDetails.classList.add('d-none');
                walletDetails.classList.remove('d-none');
                btnText.textContent = 'Lanjut ke Pembayaran';
            }
        }

        paymentOptions.forEach(option => {
            option.addEventListener('change', toggleDetails);
        });

        toggleDetails(); // initial state

        form.addEventListener('submit', function () {
            submitBtn.disabled = true;
            spinner.classList.remove('d-none');
        });
    });
</script>
@endpush
</x-app-layout>
