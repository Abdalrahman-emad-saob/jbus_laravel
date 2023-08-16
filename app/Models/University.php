<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $fillable = [
        'name',
        'logo',
    ];

    public function universityRoute()
    {
        return $this->hasMany(UniversityRoute::class, 'university_id', 'id');
    }
}
