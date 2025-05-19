<!-- filepath: c:\laragon\www\Mistify\resources\views\front\payment\upload.blade.php -->
<x-app-layout>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="card border-0 shadow-lg rounded-4">
                    <div class="card-body p-4 p-md-5">
                        <div class="mb-4 text-center">
                            <h4 class="fw-semibold mb-1">Upload Bukti Pembayaran</h4>
                            <p class="text-muted small">No. Pesanan: {{ $order->order_number }}</p>
                        </div>

                        <!-- Payment Details Summary -->
                        <div class="bg-light p-4 rounded-4 mb-4 border">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="small mb-1">
                                        <span class="text-muted">Total Pembayaran:</span>
                                        <h6 class="text-primary fw-bold mb-0">Rp {{ number_format($payment->amount, 0, ',', '.') }}</h6>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="small mb-1">
                                        <span class="text-muted">Metode Pembayaran:</span>
                                        <div class="fw-medium">
                                            <i class="bi bi-bank me-1"></i> Transfer Bank
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <form action="{{ route('payment.confirm', $order->order_number) }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- Bank Information -->
                            <div class="mb-4">
                                <h6 class="fw-bold mb-3">Informasi Rekening Pengirim</h6>

                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="bank_name" class="form-label small">Nama Bank <span class="text-danger">*</span></label>
                                            <select name="bank_name" id="bank_name" class="form-select @error('bank_name') is-invalid @enderror" required>
                                                <option value="" selected disabled>Pilih Bank</option>
                                                <option value="BCA" {{ old('bank_name') == 'BCA' ? 'selected' : '' }}>BCA</option>
                                                <option value="BNI" {{ old('bank_name') == 'BNI' ? 'selected' : '' }}>BNI</option>
                                                <option value="BRI" {{ old('bank_name') == 'BRI' ? 'selected' : '' }}>BRI</option>
                                                <option value="Mandiri" {{ old('bank_name') == 'Mandiri' ? 'selected' : '' }}>Mandiri</option>
                                                <option value="CIMB Niaga" {{ old('bank_name') == 'CIMB Niaga' ? 'selected' : '' }}>CIMB Niaga</option>
                                                <option value="Permata" {{ old('bank_name') == 'Permata' ? 'selected' : '' }}>Permata</option>
                                                <option value="BTN" {{ old('bank_name') == 'BTN' ? 'selected' : '' }}>BTN</option>
                                                <option value="Lainnya" {{ old('bank_name') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                            </select>
                                            @error('bank_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="account_number" class="form-label small">Nomor Rekening <span class="text-danger">*</span></label>
                                            <input type="text" name="account_number" id="account_number" class="form-control @error('account_number') is-invalid @enderror" value="{{ old('account_number') }}" placeholder="Contoh: 1234567890" required>
                                            @error('account_number')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="account_name" class="form-label small">Nama Pemilik Rekening <span class="text-danger">*</span></label>
                                            <input type="text" name="account_name" id="account_name" class="form-control @error('account_name') is-invalid @enderror" value="{{ old('account_name') }}" placeholder="Nama sesuai buku tabungan" required>
                                            @error('account_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Payment Details -->
                            <div class="mb-4">
                                <h6 class="fw-bold mb-3">Detail Pembayaran</h6>

                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="payment_date" class="form-label small">Tanggal Pembayaran <span class="text-danger">*</span></label>
                                            <input type="date" name="payment_date" id="payment_date" class="form-control @error('payment_date') is-invalid @enderror" value="{{ old('payment_date', date('Y-m-d')) }}" max="{{ date('Y-m-d') }}" required>
                                            @error('payment_date')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="amount" class="form-label small">Jumlah Transfer <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text">Rp</span>
                                                <input type="text" name="amount" readonly id="amount" class="form-control @error('amount') is-invalid @enderror" value="{{ old('amount', number_format($payment->amount, 0, '', '')) }}" required>
                                                @error('amount')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-text small">
                                                Harus sama dengan total tagihan: Rp {{ number_format($payment->amount, 0, ',', '.') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Payment Proof Upload -->
                            <div class="mb-4">
                                <h6 class="fw-bold mb-3">Bukti Pembayaran</h6>

                                <div class="form-group mb-3">
                                    <label for="payment_proof" class="form-label small">Unggah Bukti Transfer <span class="text-danger">*</span></label>
                                    <input type="file" name="payment_proof" id="payment_proof" class="form-control @error('payment_proof') is-invalid @enderror" accept="image/*" required>
                                    @error('payment_proof')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text small">Format yang diterima: JPG, JPEG, PNG. Maks: 2MB</div>
                                </div>

                                <div class="mb-3 d-none" id="image-preview-container">
                                    <label class="form-label small">Preview:</label>
                                    <div class="position-relative">
                                        <img id="image-preview" src="#" alt="Preview" class="img-thumbnail">
                                        <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 m-1" id="remove-image">
                                            <i class="bi bi-x"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Additional Notes -->
                            <div class="mb-4">
                                <div class="form-group">
                                    <label for="notes" class="form-label small">Catatan (Opsional)</label>
                                    <textarea name="notes" id="notes" class="form-control @error('notes') is-invalid @enderror" rows="2" placeholder="Tambahkan catatan jika diperlukan">{{ old('notes') }}</textarea>
                                    @error('notes')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-primary py-2">
                                    <i class="bi bi-check-circle me-1"></i> Konfirmasi Pembayaran
                                </button>
                            </div>
                        </form>

                        <div class="mt-4 pt-3 border-top text-center">
                            <a href="{{ route('orders.show', $order->order_number) }}" class="text-decoration-none">
                                <i class="bi bi-arrow-left me-1"></i> Kembali ke Halaman Pesanan
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Format currency input
            const amountInput = document.getElementById('amount');
            if (amountInput) {
                amountInput.addEventListener('input', function(e) {
                    // Remove non-numeric characters
                    let value = this.value.replace(/\D/g, '');

                    // Format with thousand separators for display
                    if (value) {
                        this.value = new Intl.NumberFormat('id-ID').format(value);
                    }
                });

                // On form submit, convert back to numbers only
                document.querySelector('form').addEventListener('submit', function() {
                    amountInput.value = amountInput.value.replace(/\D/g, '');
                });
            }

            // Image preview
            const paymentProofInput = document.getElementById('payment_proof');
            const imagePreview = document.getElementById('image-preview');
            const imagePreviewContainer = document.getElementById('image-preview-container');
            const removeImageBtn = document.getElementById('remove-image');

            paymentProofInput.addEventListener('change', function() {
                const file = this.files[0];

                if (file) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        imagePreview.src = e.target.result;
                        imagePreviewContainer.classList.remove('d-none');
                    }

                    reader.readAsDataURL(file);
                }
            });

            removeImageBtn.addEventListener('click', function() {
                paymentProofInput.value = '';
                imagePreviewContainer.classList.add('d-none');
            });
        });
    </script>
    @endpush
</x-app-layout>
