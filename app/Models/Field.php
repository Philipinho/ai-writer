<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    use HasFactory;

    protected $fillable = [
        'template_id', 'label', 'optional', 'name', 'placeholder', 'type', 'tooltip','order', 'minLength', 'maxLength'
    ];

    protected $hidden = ['id', 'template_id','created_at', 'updated_at'];

    public function templates()
    {
        return $this->belongsTo(Template::class);
    }
}
