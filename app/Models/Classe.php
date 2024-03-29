<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    use HasFactory;
    protected $table = 'classes';
    protected $fillable = ['name', 'description', 'order_classe', 'course_id'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
