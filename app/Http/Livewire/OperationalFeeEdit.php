<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Operasional;
use App\Models\OperationalFee;
use Illuminate\Support\Facades\Auth;

class OperationalFeeEdit extends Component
{
    public $opts = [];
    public $operationalFeeId; // Menyimpan ID investFee yang akan diedit
    public $operationalFee; // Menyimpan data investFee yang akan diedit

    public function mount($operationalFee)
    {
        $this->operationalFee = OperationalFee::find($operationalFee);
        $this->operationalFeeId = $operationalFee;

        // Inisialisasi $opts dengan data investasi yang sesuai
        foreach ($this->operationalFee->operasionals as $operasional) {
            $this->opts[] = [
                'id' => $operasional->id,
                'estimasi_opts' => intval($operasional->pivot->estimasi),
                'pemeliharaan_opts' => $operasional->pivot->pemeliharaan_opts * 100,
            ];
        }
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
        return view('livewire.operational-fee-edit', compact('operationals'));
    }
}
