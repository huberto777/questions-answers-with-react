@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <div class="d-flex align-items-center">
                            <h1>{{ $question->title }}</h1>
                            <div class="ml-auto">
                                <a href="{{ route('questions.index') }}" class="btn btn-outline-secondary">Back to all Questions</a>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="media">
                        <div id="voteQuestion"
                            auth="{{Auth::user() ?? false}}"
                            name="{{'question'}}"
                            question="{{$question}}"
                            votesCount="{{$question->votes_count}}"
                            count="{{$question->favorites_count}}"
                            isFavorited="{{$question->isFavorited}}"
                            isVoted="{{$question->isVoted}}"
                        >
                            @include ('shared._voteQuestion')
                        </div>

                        <div class="media-body">
                            {{$question->excerpt}}
                            <div class="row">
                                <div class="col-4"></div>
                                <div class="col-4"></div>
                                <div class="col-4">
                                    @include ('shared._author', [
                                        'model' => $question,
                                        'label' => 'asked'
                                    ])
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include ('answers._index', [
        'answers' => $question->answers,
        'answersCount' => $question->answers_count,
        'allAnswers' => $allAnswers,
        'question' => $question
    ])
</div>

@endsection
