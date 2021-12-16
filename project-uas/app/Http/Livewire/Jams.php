<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Jam;

class Jams extends Component
{
    public $jams, $target, $totalSaatIni, $totalMingguIni, $jam_id;

    public $isOpen = 0;

    public function render()
    {
        $this->jams = Jam::all();

        return view('livewire.jams');
    }

    public function create()
    {
        $this->resetInputFields();

        $this->openModal();
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    private function resetInputFields(){
        $this->target = '';

        $this->totalSaatIni = '';

        $this->totalMingguIni = '';

        $this->jam_id = '';
    }

    public function store()
    {
        // $this->validate([
        //     'target' => 'required',
            
        //     'totalSaatIni' => 'required',

        //     'totalMingguIni' => 'required',
        
        // ]);

        // Jam::updateOrCreate(['id' => $this->jam_id], [
        //     'target' => $this->target,
            
        //     'totalSaatIni' => $this->totalSaatIni,

        //     'totalMingguIni' => $this->totalMingguIni,
            
        // ]);
        $validateData = $this->validate([
            'target' => 'required',
            
            'totalSaatIni' => 'required',

            'totalMingguIni' => 'required',
        
        ]);

        if($this->jam_id){
            Jam::find($this->jam_id)->update($validateData);
        } else {
            Jam::create($validateData);
        }

        session()->flash('message',
            $this->jam_id ? 'Jam Updated Successfully.' : 'Jam Created Successfully.');

        $this->closeModal();

        $this->resetInputFields();
    }

    public function edit($id)
    {
        $jam = Jam::findOrFail($id);
        
        $this->jam_id = $id;
        
        $this->target = $jam->target;
        
        $this->totalSaatIni = $jam->totalSaatIni;

        $this->totalMingguIni = $jam->totalMingguIni;

        $this->openModal();
    }

    public function delete($id)
    {
        Jam::find($id)->delete();
        session()->flash('message', 'Jam Deleted Successfully.');
    }
}