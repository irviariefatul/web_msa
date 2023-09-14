<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Operasional;
use Illuminate\Support\Facades\Auth;

class OperationalFee extends Component
{
    public $opts = [];
    
    
    public function mount()
    {
        // Inisialisasi dengan satu kolom input kosong
        $this->opts[] = ['id' => null, 'estimasi_opts' => null, 'pemeliharaan_opts' => null];
    }

    public function addInput3()
    {
        // Menambahkan satu kolom input kosong Investasi
        $this->opts[] = ['id' => null, 'estimasi_opts' => null, 'pemeliharaan_opts' => null];
        $this->dispatchBrowserEvent('reApplySelect2o');
    }

    public function removeInput3($index3)
    {
        // Menghapus kolom input Investasi berdasarkan indeks
        unset($this->opts[$index3]);
        $this->opts = array_values($this->opts);
        $this->dispatchBrowserEvent('reApplySelect2o');
    }

    public function render()
    {
        $operationals = Operasional::all();
        return view('livewire.operational-fee', compact('operationals'))
            ->extends('layouts.app3');
    }
}
