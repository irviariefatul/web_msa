<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Investment;
use Illuminate\Support\Facades\Auth;

class InvestFee extends Component
{
    public $ivts = [];
    
    
    public function mount()
    {
        // Inisialisasi dengan satu kolom input kosong
        $this->ivts[] = ['id' => null, 'estimasi_ivts' => null, 'pemeliharaan_ivts' => null];
    }

    public function addInput2()
    {
        // Menambahkan satu kolom input kosong Investasi
        $this->ivts[] = ['id' => null, 'estimasi_ivts' => null, 'pemeliharaan_ivts' => null];
        $this->dispatchBrowserEvent('reApplySelect2i');
    }

    public function removeInput2($index2)
    {
        // Menghapus kolom input Investasi berdasarkan indeks
        unset($this->ivts[$index2]);
        $this->ivts = array_values($this->ivts);
        $this->dispatchBrowserEvent('reApplySelect2i');
    }

    public function render()
    {
        $investments = Investment::all();
        return view('livewire.invest-fee', compact('investments'))
            ->extends('layouts.app3');
    }
}
