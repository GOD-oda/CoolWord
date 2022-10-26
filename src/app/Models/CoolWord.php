<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\CoolWord\CoolWord
 *
 * @method static \Database\Factories\CoolWordFactory factory(...$parameters)
 * @method static Builder|CoolWord newModelQuery()
 * @method static Builder|CoolWord newQuery()
 * @method static Builder|CoolWord query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $views
 * @property string $description
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Tag[] $tags
 * @property-read int|null $tags_count
 * @method static Builder|CoolWord name(string $name)
 * @method static Builder|CoolWord whereCreatedAt($value)
 * @method static Builder|CoolWord whereDescription($value)
 * @method static Builder|CoolWord whereId($value)
 * @method static Builder|CoolWord whereName($value)
 * @method static Builder|CoolWord whereUpdatedAt($value)
 * @method static Builder|CoolWord whereViews($value)
 */
class CoolWord extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'views',
        'description'
    ];

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function scopeName(Builder $query, string $name): void
    {
        if (!empty($name)) {
            $query->where('name', 'like', "%$name%");
        }
    }
}
