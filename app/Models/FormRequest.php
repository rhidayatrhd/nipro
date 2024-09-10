<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormRequest extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function departments()
    {
        return $this->belongsTo(Department::class, 'dept_id');
    }
}
