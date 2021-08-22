<?php

namespace App\Http\Controllers;

use App\Models\Questionnaire;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    public function show(Questionnaire $questionnaire, $slug)
    {
        $questionnaire->load('questions.answers');
        return view('survey.show', compact('questionnaire'));
    }

    public function store(Questionnaire $questionnaire)
    {
        $data = request()->validate([
            'responses.*.answer_id' => 'required',
            // 'responses.*.question_id' => 'required'
        ]);
    }
}
