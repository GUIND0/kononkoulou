<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectSector extends Model
{
    use HasFactory;
    protected $table = 'sectors_has_projects';
}
