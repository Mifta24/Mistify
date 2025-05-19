<x-app-layout>
    {{-- Payment Gateway --}}
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-sm border-0">
                    <div class="card-body text-center py-5">
                        <h4 class="mb-4">Processing Payment</h4>
                        <div class="spinner-border text-primary mb-4" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p class="text-muted mb-0">Please wait while we redirect you to the payment page...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')


        {{-- Use Sandbox SDK --}}
        <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
        </script>

        <script>
            window.snap.pay('{{ $snapToken }}', {
                onSuccess: function(result) {
                    console.log('Success:', result);
                    window.location.href = '{{ route('payment.finish', $order->order_number) }}';
                },
                onPending: function(result) {
                    console.log('Pending:', result);
                    window.location.href = '{{ route('payment.finish', $order->order_number) }}';
                },
                onError: function(result) {
                    console.error('Error:', result);
                    window.location.href = '{{ route('payment.error', $order->order_number) }}';
                },
                onClose: function() {
                    console.log('Customer closed the popup without finishing the payment');
                    window.location.href = '{{ route('payment.cancel', $order->order_number) }}';
                }
            });
        </script>
    @endpush
</x-app-layout>
