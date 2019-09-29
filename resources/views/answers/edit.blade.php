@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row mt-4">
	    <div class="col-md-12">
	        <div class="card">
	            <div class="card-body">
	                <div class="card-title">
	                    <h2>Editing answer for question: <strong>{{ $question->title }}</strong></h2>
	                </div>
	                <hr>
	                <form action="{{ route('questions.answers.update', [$question->slug, $answer->id]) }}" method="post">
	                    @csrf
	                    {{ method_field('patch') }}
	                    <div class="form-group">
	                        <textarea class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}" name="body" id="" cols="30" rows="7">{{ $answer->body  }}
	                        </textarea>
	                        @if($errors->has('body'))
	                            <div class="invalid-feedback">
	                                {{ $errors->first('body') }}
	                            </div>
	                        @endif
	                    </div>
	                    <div class="form-group">
	                        <button type="submit" class="btn btn-lg btn-outline-primary">update</button>
	                    </div>
	                </form>
	            </div>
	        </div>
	    </div>
	</div>
</div>
@endsection
