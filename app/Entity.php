<?php

namespace App;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Entity
 */
class Entity extends Model
{
    use SoftDeletes, Auditable;

    public $table = 'entities';

    public static $searchable = [
        'name',
        'description',
        'security_level',
        'contact_point',
        'entity_type',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'description',
        'security_level',
        'contact_point',
        'is_external',
        'entity_type',
        'parent_entity_id',
    ];

    public function databases() : HasMany
    {
        return $this->hasMany(Database::class, 'entity_resp_id', 'id')->orderBy('name');
    }

    public function applications() : HasMany
    {
        return $this->hasMany(MApplication::class, 'entity_resp_id', 'id')->orderBy('name');
    }

    public function sourceRelations() : HasMany
    {
        return $this->hasMany(Relation::class, 'source_id', 'id')->orderBy('name');
    }

    public function destinationRelations() : HasMany
    {
        return $this->hasMany(Relation::class, 'destination_id', 'id')->orderBy('name');
    }

    public function entitiesMApplications() : BelongsToMany
    {
        return $this->belongsToMany(MApplication::class)->orderBy('name');
    }

    public function entitiesProcesses() : BelongsToMany
    {
        return $this->belongsToMany(Process::class)->orderBy('name');
    }

    public function parentEntity() : BelongsTo
    {
        return $this->belongsTo(Entity::class, 'parent_entity_id');
    }

    public function entities() : HasMany
    {
        return $this->hasMany(Entity::class, 'parent_entity_id', 'id')->orderBy('name');
    }

}
