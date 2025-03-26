<?php

namespace App;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Lan
 */
class Lan extends Model
{
    use HasFactory, SoftDeletes, Auditable;

    public $table = 'lans';

    public static $searchable = [
        'name',
        'description',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'description',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function lansMen(): BelongsToMany
    {
        return $this->belongsToMany(Man::class)->orderBy('name');
    }

    public function lansWans(): BelongsToMany
    {
        return $this->belongsToMany(Wan::class)->orderBy('name');
    }
}
