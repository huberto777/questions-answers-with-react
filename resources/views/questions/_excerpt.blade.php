<div class="media post">
    <div class="d-flex flex-column counters">
        <div class="vote">
            <strong>{{ $question->votes_count }}</strong> {{ Str::plural('vote', $question->votes_count) }}
        </div>
        <div class="status {{ $question->status }} ">
            <strong>{{ $question->answers_count }}</strong> {{ Str::plural('answer', $question->answers_count) }}
        </div>
        <div class="view">
            {{ $question->views . " " . Str::plural('view', $question->views) }}
        </div>
    </div>
    <div class="media-body">
        <div class="d-flex align-items-center">
            <h3 class="mt-0"><a href="{{ $question->url }}">{{ $question->title }}</a></h3>
            <div class="ml-auto">
                @can('update', $question)
                    <a href="{{ route('questions.edit', $question->slug) }}" class="btn btn-sm btn-outline-primary"><i class="far fa-edit"></i></a>
                @endcan
                @can('delete', $question)
                    <form class="form-delete" action="{{ route('questions.destroy',$question->slug) }}" method="post">
                        {{ method_field('delete') }}
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('are you sure?')"><i class="far fa-trash-alt"></i></button>
                    </form>
                @endcan
            </div>
        </div>
        <p class="lead">
            Asked by
            <a href="{{ $question->user->url }}">{{ $question->user->name }}</a>
            <small class="text-muted">{{ $question->created_date }}</small>
        </p>
        {{-- str_limit(strip_tags($question->body),250) --}}
        {{ $question->excerpt(250) }}
    </div>
</div>
