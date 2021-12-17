<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Nilai extends Model
{
    use HasFactory;

    use Sortable;
    
    protected $fillable = [
        'semesterName', 'mapelName', 'nilaiName', 'nilai',
    ];

    public $sortable = ['semesterName',];
}
