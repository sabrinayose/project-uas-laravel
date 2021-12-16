<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Material;

class Materials extends Component
{
    public $materials, $materialName, $progress, $material_id;

    public $isOpen = 0;

    public function render()
    {
        $this->materials = Material::all();

        return view('livewire.materials');
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
        $this->materialName = '';

        $this->progress = '';

        $this->material_id = '';
    }

    public function store()
    {
        $this->validate([
            'materialName' => 'required',
            
            'progress' => 'required',
        
        ]);

        Material::updateOrCreate(['id' => $this->material_id], [
            'materialName' => $this->materialName,
            
            'progress' => $this->progress,
            
        ]);

        session()->flash('message',
            $this->material_id ? 'Material Updated Successfully.' : 'Material Created Successfully.');

        $this->closeModal();

        $this->resetInputFields();
    }

    public function edit($id)
    {
        $material = Material::findOrFail($id);
        
        $this->material_id = $id;
        
        $this->materialName = $material->materialName;
        
        $this->progress = $material->progress;

        $this->openModal();
    }

    public function delete($id)
    {
        Material::find($id)->delete();
        session()->flash('message', 'Material Deleted Successfully.');
    }

}
