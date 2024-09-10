<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    // protected $table = ['departments', 'sections'];
    // protected $with = ['departments'];

    public function departments()
    {
        return $this->belongsTo(Department::class, 'dept_id');
    }
}
