<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Template extends Model
{
    use HasFactory;
    use HasUuid;
    use SoftDeletes;


    protected $guarded = [''];

    protected $hidden = ['uuid', 'user_id', 'prompt', 'created_at', 'updated_at'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'template_category');
    }

    public function documents(): HasMany
    {
        return $this->hasMany(Document::class);
    }

    public function fields(): HasMany
    {
        return $this->hasMany(Field::class);
    }

    public function teamsFavorited()
    {
        return $this->belongsToMany(Team::class, 'favorite_template');
    }

}
