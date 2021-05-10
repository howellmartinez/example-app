<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['name', 'description', 'client'];

    use HasFactory;

    /**
     * Get the stages for the project.
     */
    public function stages()
    {
        return $this->hasMany(Stage::class);
    }
}
