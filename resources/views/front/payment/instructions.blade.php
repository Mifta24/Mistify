<!-- filepath: c:\laragon\www\Mistify\resources\views\front\payment\instructions.blade.php -->
<x-app-layout>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card border-0 shadow-lg rounded-4">
                <div class="card-body p-5">

                    <div class="mb-4 text-center">
                        <h4 class="fw-semibold mb-1">Instruksi Pembayaran</h4>
                        <p class="text-muted small">Silakan transfer sesuai detail di bawah ini</p>
                    </div>

                    <!-- Payment Details -->
                    <div class="bg-light p-4 rounded-4 mb-4 border border-dashed">
                        <h6 class="fw-bold mb-3 d-flex align-items-center">
                            <i class="bi bi-bank me-2 text-primary fs-5"></i>
                            Detail Transfer Bank
                        </h6>
                        <div class="mb-2 small"><strong>Bank:</strong> {{ $bankDetails['bank_name'] }}</div>
                        <div class="mb-2 small"><strong>No Rekening:</strong> <span class="font-monospace">{{ $bankDetails['account_number'] }}</span></div>
                        <div class="mb-2 small"><strong>Atas Nama:</strong> {{ $bankDetails['account_name'] }}</div>
                        <div class="mb-0 small"><strong>Total Transfer:</strong> <span class="text-primary fw-bold">Rp {{ number_format($bankDetails['amount'], 0, ',', '.') }}</span></div>
                    </div>

                    <!-- Alert Info -->
                    <div class="alert alert-warning d-flex align-items-start gap-3 small mb-4">
                        <i class="bi bi-exclamation-triangle-fill text-warning fs-5"></i>
                        <div>
                            Harap selesaikan pembayaran dalam waktu <strong>24 jam</strong> untuk menghindari pembatalan otomatis.
                        </div>
                    </div>

                    <!-- Payment Steps -->
                    <div class="mb-4">
                        <h6 class="fw-bold mb-3">Langkah Pembayaran:</h6>
                        <ol class="ps-3 small">
                            <li class="mb-2">Transfer sesuai jumlah yang tertera ke rekening di atas</li>
                            <li class="mb-2">Simpan bukti transfer (screenshot/foto)</li>
                            <li class="mb-2">Upload bukti transfer melalui tombol di bawah</li>
                            <li class="mb-2">Pembayaran akan diverifikasi dalam 1x24 jam kerja</li>
                        </ol>
                    </div>

                    <!-- Upload Button -->
                    <a href="{{ route('payment.upload', $order->order_number) }}" class="btn btn-success w-100 d-flex justify-content-center align-items-center gap-2 mb-3">
                        <i class="bi bi-upload"></i>
                        <span>Upload Bukti Pembayaran</span>
                    </a>

                    <!-- Order Details Button -->
                    <a href="{{ route('orders.show', $order->order_number) }}" class="btn btn-outline-primary w-100 d-flex justify-content-center align-items-center gap-2">
                        <i class="bi bi-receipt-cutoff"></i>
                        <span>Lihat Detail Pesanan</span>
                    </a>

                </div>
            </div>
        </div>
    </div>
</div>
</x-app-layout>
