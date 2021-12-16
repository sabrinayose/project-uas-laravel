<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Assignment;

class Assignments extends Component
{
    public $assigments, $assigmentName, $progress, $assignment_id;

    public $isOpen = 0;

    public function render()
    {
        $this->assignments = Assignment::all();

        return view('livewire.assignments');
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
        $this->assignmentName = '';

        $this->progress = '';

        $this->assignment_id = '';
    }

    public function store()
    {
        $validateData = $this->validate([
            'assignmentName' => 'required',
            
            'progress' => 'required',
        
        ]);

        if($this->assignment_id){
            Assignment::find($this->assignment_id)->update($validateData);
        } else {
            Assignment::create($validateData);
        }
        // Assignment::updateOrCreate(['id' => $this->assignment_id], [
        //     'assignmentName' => $this->assigmentName,
            
        //     'progress' => $this->progress,
            
        // ]);

        session()->flash('message',
            $this->assignment_id ? 'Assignment Updated Successfully.' : 'Assignment Created Successfully.');

        $this->closeModal();

        $this->resetInputFields();
    }

    public function edit($id)
    {
        $assignment = Assignment::findOrFail($id);
        
        $this->assignment_id = $id;
        
        $this->assignmentName = $assignment->assignmentName;
        
        $this->progress = $assignment->progress;
        

        $this->openModal();
    }

    public function delete($id)
    {
        Assignment::find($id)->delete();
        session()->flash('message', 'Assignment Deleted Successfully.');
    }
}
