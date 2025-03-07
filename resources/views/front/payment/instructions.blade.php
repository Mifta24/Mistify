<x-app-layout>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">
                        <h4 class="mb-4">Payment Instructions</h4>
                        <div class="alert alert-info">
                            <h5 class="alert-heading">Bank Transfer Details</h5>
                            <p class="mb-1"><strong>Bank:</strong> {{ $bankDetails['bank_name'] }}</p>
                            <p class="mb-1"><strong>Account Number:</strong> {{ $bankDetails['account_number'] }}</p>
                            <p class="mb-1"><strong>Account Name:</strong> {{ $bankDetails['account_name'] }}</p>
                            <p class="mb-0"><strong>Amount:</strong> Rp {{ number_format($bankDetails['amount'], 0, ',', '.') }}</p>
                        </div>

                        <div class="alert alert-warning">
                            <i class="bi bi-exclamation-triangle me-2"></i>
                            Please complete your payment within 24 hours
                        </div>

                        <a href="{{ route('orders.show', $order) }}" class="btn btn-primary">
                            View Order Details
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
