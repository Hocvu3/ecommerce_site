<div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
    <div class="fp_dashboard_body dashboard_review">
        <h3>review</h3>
        <div class="fp__review_area">
            <div class="fp__comment pt-0 mt_20">
                @foreach ($ratings as $rating)
                    <div class="fp__single_comment m-0 border-0">
                        <img src="{{ asset($rating->products->thumbnail_image) }}" alt="review" class="img-fluid">
                        <div class="fp__single_comm_text">
                            <h3><a href="#">{{ $rating->products->name }}</a>
                                <span>{{ $rating->created_at }}</span></h3>
                            <span class="rating">
                                @for ($i = 0; $i < $rating->rating; $i++)
                                    <i class="fas fa-star"></i>
                                @endfor
                            </span>
                            <p>{{ $rating->comment }}</p>
                            @if ($rating->status == 0)
                                <span class="status active">pending</span>
                            @elseif ($rating->status == 1)
                                <span class="status danger">approved</span>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
