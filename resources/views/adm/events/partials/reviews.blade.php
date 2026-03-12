
<div id="reviews-container">
    @foreach ($reviews as $review)
        <div class="review mb-2 p-2 border rounded">
            <p>{{ $review->content }}</p>
            <small>{{ $review->created_at->format('d.m.Y H:i') }}</small>
        </div>
    @endforeach

    <div class="pagination-container mt-3">
        {{ $reviews->links() }}
    </div>
</div>
