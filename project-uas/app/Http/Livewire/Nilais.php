<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Nilai;

class Nilais extends Component
{
    public $nilais, $semesterName, $mapelName, $nilaiName, $nilai, $nilai_id;

    public $isOpen = 0;

    public function render()
    {
        $this->nilais = Nilai::all();

        return view('livewire.nilais');
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
        $this->semesterName = '';

        $this->mapelName = '';

        $this->nilaiName = '';

        $this->nilai = '';

        $this->nilai_id = '';
    }

    public function store()
    {
        $this->validate([
            'semesterName' => 'required',
            
            'mapelName' => 'required',

            'nilaiName' => 'required',

            'nilai' => 'required',
        
        ]);

        Nilai::updateOrCreate(['id' => $this->nilai_id], [
            'semesterName' => $this->semesterName,

            'mapelName' => $this->mapelName,

            'nilaiName' => $this->nilaiName,
            
            'nilai' => $this->nilai,
        ]);

        session()->flash('message',
            $this->nilai_id ? 'Nilai Updated Successfully.' : 'Nilai Created Successfully.');

        $this->closeModal();

        $this->resetInputFields();
    }

    public function edit($id)
    {
        $nilai1 = Nilai::findOrFail($id);
        
        $this->nilai_id = $id;

        $this->semesterName = $nilai1->semesterName;

        $this->mapelName = $nilai1->mapelName;
        
        $this->nilaiName = $nilai1->nilaiName;
        
        $this->nilai = $nilai1->nilai;
        

        $this->openModal();
    }

    public function delete($id)
    {
        Nilai::find($id)->delete();
        session()->flash('message', 'Nilai Deleted Successfully.');
    }

    public function sortBy($columnName)
    {
        dd('here');
    }

}
