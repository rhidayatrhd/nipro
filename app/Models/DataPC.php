<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPC extends Model
{
    use HasFactory;
    protected $guarded = ['id']; 
    protected $table = 'computers';

    public function departments()
    {
        return $this->belongsTo(Department::class, 'dept_id');
    }

    public function sections()
    {
        return $this->belongsTo(Section::class, 'sect_id');
    }
}
 