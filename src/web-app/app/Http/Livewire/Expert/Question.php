<?php

namespace App\Http\Livewire\Expert;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Question extends Component
{
    public $questions;

    public $languages;

    public $answer;

    public $result;

    public $answers = [];

    public $currentIndex = 0;

    public $size = 0;

    public $answersIndex = 0;

    public $progress = 0;

    protected $rules = [
        'answer' => 'required',
    ];

    public function startOver()
    {
        return $this->resetExcept(['questions', 'languages', 'size']);
    }

    private function calculateProgress()
    {
        $this->progress = round(($this->currentIndex * 100) / ($this->size + 1), 2);
    }

    private function loadData()
    {
        $this->languages = json_decode(File::get(config('expert.languages')), true);
        $this->questions = json_decode(File::get(config('expert.questions')), true);
        $this->size = count($this->questions) - 1;
    }

    private function updateAnswers()
    {
        if ($this->answer == 'yes') {
            $this->answers[$this->answersIndex] = $this->questions[$this->currentIndex]['fact'];
            $this->answersIndex++;
        }

        $this->reset('answer');
        $this->currentIndex++;
    }

    public function nextQuestion()
    {
        $this->validate();

        if ($this->currentIndex == $this->size) {
            $this->updateAnswers();
            $this->calculateProgress();

            return $this->fetchFromExpertSystem();
        }

        $this->updateAnswers();

        return $this->calculateProgress();
    }

    private function fetchFromExpertSystem()
    {
        $response = Http::post(config('expert.endpoint'), [
            'facts' => $this->answers,
        ]);

        $this->result = json_decode($response->body(), true);
    }

    public function mount()
    {
        return $this->loadData();
    }

    public function render()
    {
        return view('livewire.expert.question');
    }
}
