<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PCSpec extends Model
{
    use HasFactory;
    protected $guarded = 'id';
    protected $table = 'computer_spesifications';

    public function department()
    {
        return $this->belongsTo(Department::class, 'dept_id');
    } 

    public function sections()
    {
        return $this->belongsTo(Section::class, 'sect_id');
    } 

}
