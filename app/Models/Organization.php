<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Сущность для хранения организаций
 *
 * @method static orderBy(string $string, string $string1)
 * @method static create(array $all)
 * @method static findOrFail(int $id)
 * @method static latest()
 */
class Organization extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'organizations';

    /**
     * @inheritdoc
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Получить отделы организации
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function departments(): HasMany
    {
        return $this->hasMany(Department::class);
    }

    /**
     * Получить должности организации
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function positions(): HasManyThrough
    {
        return $this->hasManyThrough(Position::class, Department::class);
    }

    /**
     * Получить сотрудников организации
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
