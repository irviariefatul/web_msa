<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Investment;
use App\Models\InvestFee;
use Illuminate\Support\Facades\Auth;

class InvestFeeEdit extends Component
{
    public $ivts = [];
    public $investFeeId; // Menyimpan ID investFee yang akan diedit
    public $investFee; // Menyimpan data investFee yang akan diedit

    public function mount($investFee)
    {
        $this->investFee = InvestFee::find($investFee);
        $this->investFeeId = $investFee;

        // Inisialisasi $ivts dengan data investasi yang sesuai
        foreach ($this->investFee->investments as $investment) {
            $this->ivts[] = [
                'id' => $investment->id,
                'estimasi_ivts' => intval($investment->pivot->estimasi),
                'pemeliharaan_ivts' => $investment->pivot->pemeliharaan_ivts * 100,
            ];
        }
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
        return view('livewire.invest-fee-edit', compact('investments'));
    }
}
