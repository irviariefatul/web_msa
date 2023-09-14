<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\PerhitunganGaji;
use Illuminate\Support\Facades\Auth;

class HRFeeEdit extends Component
{
    public $hrs = [];
    
    
    public function mount($serviceFee)
    {
    // Inisialisasi dengan data yang akan diedit
    $this->hrs = $serviceFee->perhitunganGajis->map(function ($item) {
        return [
            'id' => $item->id,
            'estimasi' => intval($item->pivot->estimasi),
        ];
    })->toArray();
}
   

    public function addInput()
    {
        // Menambahkan satu kolom input kosong
        $this->hrs[] = ['id' => null, 'estimasi' => null];
        $this->dispatchBrowserEvent('reApplySelect2');
    }

    public function removeInput($index)
    {
        // Menghapus kolom input berdasarkan indeks
        unset($this->hrs[$index]);
        $this->hrs = array_values($this->hrs);
        $this->dispatchBrowserEvent('reApplySelect2');
    }

    public function render()
    {
        $perhitungan_gajis = PerhitunganGaji::all();
        return view('livewire.h-r-fee-edit', compact('perhitungan_gajis'))
            ->extends('layouts.app3');
    }
}

