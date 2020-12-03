<div class="card bg-light mb-3">
    <div class="card-header">{{$comment->user['name']}} -
        @if ($comment->created_at->format('Y') == date('Y'))
            <small class="text-muted">{{$comment->created_at->format('M j')}}</small>
        @else
            <small class="text-muted">{{$comment->created_at->format('M j, Y')}}</small>
        @endif
    </div>
    <div class="card-body">
        <p class="card-text">{{$comment->comment}}</p>
    </div>
</div>


