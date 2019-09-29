@if($answersCount > 0)
    <div class="row mt-4">
        <div class="col-md-12">
            @include('layouts._messages')
            <div class="card">
                <div class="card-body">
                    <div id="answers"
                        answers="{{$answers}}"
                        auth="{{Auth::user()}}"
                        name="{{'answer'}}"
                        count="{{$answers->count()}}"
                        question="{{$question}}"
                        >
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
