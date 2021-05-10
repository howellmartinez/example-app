<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
    use HasFactory;

    protected $fillable = ['description'];

    /**
     * Get the project that owns the stage.
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
