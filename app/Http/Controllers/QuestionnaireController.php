<?php

namespace App\Http\Controllers;

use App\Models\Questionnaire;
use Illuminate\Http\Request;

class QuestionnaireController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function validateData()
    {
        return request()->validate([
            'title' => 'required',
            'purpose' => 'required'
        ]);
    }

    public function create()
    {
        return view('questionnaire.create');
    }

    public function store()
    {
        /*
        $data = request()->validate([
            'title' => 'required',
            'purpose' => 'required'
        ]);

        // using direct method
          $data['user_id'] = auth()->user()->id;
          $questionnaire = Questionnaire::create($data);
        */

        // using relationships
        $questionnaire = auth()->user()->questionnaires()->create($this->validateData());

        return redirect('questionnaires/' . $questionnaire->id);
    }

    public function show(Questionnaire $questionnaire)
    {
        // lazy loading
        $questionnaire->load('questions.answers');

        return view('questionnaire.show', compact('questionnaire'));
    }
}
