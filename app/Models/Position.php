<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Сущность для хранения должности
 */
class Position extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'positions';

    /**
     * @inheritdoc
     *
     * @var array
     */
    protected $guarded = [];
}
