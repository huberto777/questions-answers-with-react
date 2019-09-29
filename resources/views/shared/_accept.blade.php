@can('accept', $model)
    <a title="mark this answer as best answer"
        class="{{ $model->status }} mt-2"
        onclick="event.preventDefault(); document.getElementById('accept-answer-{{ $model->id }}').submit();"
        >
        <i class="fas fa-check fa-2x"></i>
    </a>
    <form id="accept-answer-{{ $model->id }}" action="{{ route('answers.accept', $model->id) }}" method="post" style="display: none;">
        {{ csrf_field() }}
    </form>
@else
    @if($model->is_best)
        <a title="the question owner accepted this answer as best answer" class="{{ $model->status }} mt-2">
            <i class="fas fa-check fa-2x"></i>
        </a>
    @endif
@endcan
{{-- const Accept = props => {
    return (
        <>
            <a href="#">ss</a>
        </>
    )
} --}}
