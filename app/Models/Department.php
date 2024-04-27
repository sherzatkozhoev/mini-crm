<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Сущность для хранения отделов
 *
 * @method static create(array $array)
 */
class Department extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'departments';

    /**
     * @inheritdoc
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Получить должности отдела
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function positions(): HasMany
    {
        return $this->hasMany(Position::class);
    }
}
