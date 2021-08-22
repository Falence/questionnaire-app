@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>{{ $questionnaire->title }}</h1>

                <form action="/surveys/{{ $questionnaire->id }}-{{ Str::slug($questionnaire->title) }}" method="post">
                    @csrf

                    @foreach($questionnaire->questions as $key => $question)
                        <div class="card mt-3">
                            <div class="card-header"><strong>{{ $key + 1 }})</strong> {{ $question->question }}</div>

                            <div class="card-body">
                                @error('responses.' . $key . '.answer_id')
                                    <small class="text-danger">An answer is required</small>
                                @enderror

                                <ul class="list-group">
                                    @foreach($question->answers as $answer)
                                        <label for="answer{{ $answer->id }}">
                                            <li class="list-group-item">
                                                <input class="mr-2" type="radio" value="{{ $answer->id }}"
                                                    {{ (old('responses.' . $key . '.answer_id') == $answer->id) ? 'checked' : '' }}
                                                       name="responses[{{ $key }}][answer_id]" id="answer{{ $answer->id }}">
                                                {{ $answer->answer }}
                                                <input type="hidden" name="responses[{{ $key }}][question_id]" value="{{ $question->id }}">
                                            </li>
                                        </label>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endforeach

                    <button class="btn btn-dark mt-3" type="submit">Submit</button>
                </form>

            </div>
        </div>
    </div>
@endsection
