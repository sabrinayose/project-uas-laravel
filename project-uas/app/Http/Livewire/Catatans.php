<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Catatan;

class Catatans extends Component
{
    public $catatans, $catatanName, $catatanText, $catatan_id;

    public $isOpen = 0;

    public function render()
    {
        $this->catatans = Catatan::all();

        return view('livewire.catatans');
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
        $this->catatanName = '';

        $this->catatanText = '';

        $this->catatan_id = '';
    }

    public function store()
    {
        $this->validate([
            'catatanName' => 'required',
            
            'catatanText' => 'required',
        
        ]);

        Catatan::updateOrCreate(['id' => $this->catatan_id], [
            'catatanName' => $this->catatanName,
            
            'catatanText' => $this->catatanText,
            
        ]);

        session()->flash('message',
            $this->catatan_id ? 'Catatan Updated Successfully.' : 'Catatan Created Successfully.');

        $this->closeModal();

        $this->resetInputFields();
    }

    public function edit($id)
    {
        $catatan = Catatan::findOrFail($id);
        
        $this->catatan_id = $id;
        
        $this->catatanName = $catatan->catatanName;
        
        $this->catatanText = $catatan->catatanText;
        

        $this->openModal();
    }

    public function delete($id)
    {
        Catatan::find($id)->delete();
        session()->flash('message', 'Catatan Deleted Successfully.');
    }
}
