<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Allowance;

class InputAllowance extends Component
{
    public $inputs = [];
    public $allowances = [];

    public function mount()
    {
        $this->allowances = Allowance::all();
        $this->inputs[] = ['id' => null];
    }

    public function addInput()
    {
        $this->inputs[] = ['id' => null];
        $this->dispatchBrowserEvent('reApplySelect2');
    }

    public function removeInput($index)
    {
        unset($this->inputs[$index]);
        $this->inputs = array_values($this->inputs);
        $this->dispatchBrowserEvent('reApplySelect2');
    }

    public function render()
    {
        return view('livewire.input-allowance', ['allowances' => $this->allowances])
            ->extends('layouts.app3');
    }
}
