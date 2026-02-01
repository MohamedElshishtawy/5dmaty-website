<link rel="stylesheet" href="{{ asset('css/reviews.css') }}">
<div class="facebook-reviews-section">
    <div class="reviews-container">
        <!-- Header -->
        <div class="reviews-header">
            <div class="header-content">
                <h2 class="reviews-title">تقييم عملائنا</h2>
                <a href="https://www.facebook.com/5damate" target="_blank" class="facebook-btn">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                    </svg>
                    <span>Review us on Facebook</span>
                </a>
            </div>
            <div class="rating-badge">
                <div class="stars">
                    @for($i = 0; $i < 5; $i++)
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="#FFC107">
                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                        </svg>
                    @endfor
                </div>
                <span class="rating-score">4.8</span>
                <span class="rating-count">({{ count($reviews) ?? 16 }})</span>
            </div>
        </div>

        <!-- Reviews Grid -->
        <div class="reviews-grid">
            @forelse($reviews as $review)
                <div class="review-card">
                    <div class="card-header">
                        @if($review['avatar'] ?? null)
                            <img src="{{ $review['avatar'] }}" alt="{{ $review['name'] }}" class="avatar">
                        @endif
                        <div class="user-info">
                            <h3 class="user-name">{{ $review['name'] }}</h3>
                            <span class="review-date">{{ $review['date'] ?? now()->format('M d, Y') }}</span>
                        </div>
                        <div class="media-icon">
                            <svg class="fb-icon" width="16" height="16" viewBox="0 0 24 24" fill="#1877F2">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </div>
                    </div>

                    <div class="card-rating">
                        @for($i = 0; $i < $review['rating']; $i++)
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="#FFC107">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                            </svg>
                        @endfor
                    </div>

                    <p class="review-text">{{ $review['text'] }}</p>

                    @if(strlen($review['text']) > 150)
                        <a href="https://www.facebook.com/5damate" target="_blank" class="read-more">Read more</a>
                    @endif
                </div>
            @empty
                <div class="no-reviews">
                    <p>No reviews yet. Be the first to review!</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

<script src="{{ asset('js/reviews.js') }}"></script>