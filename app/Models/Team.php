<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Jetstream\Events\TeamCreated;
use Laravel\Jetstream\Events\TeamDeleted;
use Laravel\Jetstream\Events\TeamUpdated;
use Laravel\Jetstream\Team as JetstreamTeam;

class Team extends JetstreamTeam
{
    use HasFactory;
    use HasUuid;
    use SoftDeletes;


    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'personal_team' => 'boolean',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'personal_team',
    ];

    /**
     * The event map for the model.
     *
     * @var array<string, class-string>
     */
    protected $dispatchesEvents = [
        'created' => TeamCreated::class,
        'updated' => TeamUpdated::class,
        'deleted' => TeamDeleted::class,
    ];

    public function documents(): HasMany
    {
        return $this->hasMany(Document::class);
    }

    public function documentContents(): HasMany
    {
        return $this->hasMany(DocumentContent::class);
    }

    public function favoriteTemplates(): BelongsToMany
    {
        return $this->belongsToMany(Template::class, 'favorite_template');
    }

    public function teamCredits(): HasOne
    {
        return $this->hasOne(TeamCredit::class);
    }

    public function subscription(): HasOne
    {
        return $this->hasOne(Subscription::class, 'stripe_customer_id', 'stripe_id');
    }

}
