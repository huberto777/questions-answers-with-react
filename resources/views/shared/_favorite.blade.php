<a title="click to mark as favorite {{ $name }} (click again to undo)" class="favorite mt-2 {{ Auth::guest() ? 'off' : ($model->is_favorited ? 'favorited' : '') }}">
    <i class="fas fa-star fa-2x"></i>
    <span class="favorites-count">{{ $model->favorites_count }}</span>
</a>
@auth
    <form id='favorite-{{ $name }}-{{ $model->slug }}' action="/{{ $firstURISegment }}/{{ $model->slug }}/favorites" method="post">
        {{ csrf_field() }}
        @if($model->is_favorited)
            {{ method_field('delete') }}
        @endif
    </form>
@endauth
