<x-app-layout>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">
                        <h4 class="card-title mb-4">Review Product</h4>

                        <div class="d-flex mb-4">
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}"
                                 class="rounded-3 me-3" style="width: 80px; height: 80px; object-fit: cover;">
                            <div>
                                <h5 class="mb-1">{{ $product->name }}</h5>
                                <p class="text-muted mb-0">Order #{{ $order->order_number }}</p>
                            </div>
                        </div>

                        <form action="{{ route('reviews.store', [$order, $product]) }}" method="POST">
                            @csrf

                            <div class="mb-4">
                                <label class="form-label d-block">Rating</label>
                                <div class="star-rating text-center">
                                    <input type="hidden" name="rating" id="selected-rating" required>
                                    <div class="stars">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <i class="bi bi-star star-item" data-rating="{{ $i }}"></i>
                                        @endfor
                                    </div>
                                    <small class="text-muted mt-2 d-block rating-text">Click to rate</small>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Your Review</label>
                                <textarea name="comment" rows="4" class="form-control"
                                    placeholder="Share your experience with this product..."></textarea>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-check2-circle me-2"></i>Submit Review
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
    <style>
        .star-rating .stars {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
        }
        .star-rating .star-item {
            font-size: 2rem;
            color: #dee2e6;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .star-rating .star-item:hover,
        .star-rating .star-item.active {
            color: #ffc107;
            transform: scale(1.1);
        }
        .star-rating .stars:hover .star-item {
            color: #dee2e6;
            transform: none;
        }
        .star-rating .stars:hover .star-item:hover,
        .star-rating .stars:hover .star-item:hover ~ .star-item {
            color: #ffc107;
            transform: scale(1.1);
        }
    </style>
    @endpush

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const stars = document.querySelectorAll('.star-item');
            const ratingInput = document.getElementById('selected-rating');
            const ratingText = document.querySelector('.rating-text');

            const ratingMessages = [
                'Click to rate',
                'Poor',
                'Fair',
                'Good',
                'Very Good',
                'Excellent'
            ];

            stars.forEach(star => {
                star.addEventListener('click', function() {
                    const rating = this.dataset.rating;
                    ratingInput.value = rating;

                    // Update stars
                    stars.forEach(s => {
                        if (s.dataset.rating <= rating) {
                            s.classList.remove('bi-star');
                            s.classList.add('bi-star-fill');
                            s.classList.add('active');
                        } else {
                            s.classList.remove('bi-star-fill');
                            s.classList.add('bi-star');
                            s.classList.remove('active');
                        }
                    });

                    // Update rating text
                    ratingText.textContent = ratingMessages[rating];
                });
            });
        });
    </script>
    @endpush
</x-app-layout>
