<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Allowance;

class InputAllowanceEdit extends Component
{
    public $inputs = []; // Properti untuk menyimpan data allowanaces yang akan di-edit

    public function mount($existingAllowances)
    {
        // Mengisi properti $inputs dengan data allowances yang sudah ada
        foreach ($existingAllowances as $index => $allowance) {
            $this->inputs[$index] = ['id' => $allowance->id];
        }
    }

    public function addInput()
    {
        // Metode untuk menambah input field allowances
        $this->inputs[] = ['id' => null];
    }

    public function removeInput($index)
    {
        // Metode untuk menghapus input field allowances
        unset($this->inputs[$index]);
        $this->inputs = array_values($this->inputs);
    }

    public function render()
    {
        $allowances = Allowance::all();
        return view('livewire.input-allowance-edit', [
            'allowances' => $allowances,
        ]);
    }
}
