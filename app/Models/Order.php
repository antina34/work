<?php /** @noinspection PhpMissingFieldTypeInspection */

namespace App\Models;

use App\Traits\TimeTrait;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @method static madeToday()
 * @method static lastWeekSold()
 * @method static ofUser($userId)
 * @method static ofUserLastWeek($userId)
 * @method static ofStatus(int $STATUS_SUCCESS)
 * @method static findOrFail(int $orderId)
 * @method static count()
 * @method static select(string[] $array)
 * @method where(string $string, string $string1, $id)
 * @method static updateOrCreate(string[] $array, array $array1)
 *
 * @property mixed user_id
 * @property mixed product_id
 * @property int|mixed subscription_plan_id
 * @property mixed price
 * @property int|mixed status
 * @property bool|mixed active_until
 * @property mixed created_at
 * @property mixed invoice_id
 */
class Order extends Model
{
    use TimeTrait;

    public const STATUS_SUCCESS = 'SUCCESS';
    public const STATUS_PENDING = 'PENDING';
    public const STATUS_FAILED = 'FAILED';
    public const STATUS_EXPIRED = 'EXPIRED';

    /**
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'product_id',
        'subscription_plan_id',
        'invoice_id',
        'price',
        'status',
        'active_until'
    ];

    /**
     * The order has an invoice.
     *
     * @return HasOne
     */
    public function invoice(): HasOne
    {
        return $this->hasOne(Invoice::class);
    }

    /**
     * Get the user's first name.
     *
     * @return string
     * @throws Exception
     * @noinspection PhpUnused
     */
    public function getDateFormattedAttribute(): string
    {
        return Carbon::parse($this->created_at)->format('M d Y');
    }

    /**
     * Scope a query to only include particular order status
     *
     * @param Builder $query
     * @param string $status
     * @return Builder
     * @noinspection PhpUnused
     */
    public function scopeOfStatus($query, string $status): Builder
    {
        return $query->where('status', $status);
    }

    /**
     * Scope a query to only include users records
     *
     * @param Builder $query
     * @param int $userId
     * @return Builder
     * @noinspection PhpUnused
     */
    public function scopeOfUser($query, int $userId): Builder
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Scope a query to only include users records from Last week
     *
     * @param Builder $query
     * @return Builder
     * @noinspection PhpUnused
     */
    public function scopeOfUserLastWeek(Builder $query): Builder
    {
        return $this->getScopeLastWeek($query);
    }

    /**
     * Scope a query to only include today records
     *
     * @param  Builder  $query
     * @return Builder
     * @noinspection PhpUnused
     */
    public function scopeMadeToday($query): Builder
    {
        return $query->where('created_at', '>=', Carbon::today());
    }

    /**
     * Scope a query to only include today records
     *
     * @param  Builder  $query
     * @return Builder
     * @noinspection PhpUnused
     */
    public function scopeLastWeekSold(Builder $query): Builder
    {
        return $this->getScopeLastWeek($query);
    }

    /**
     * Scope a query to only include today records
     *
     * @param  Builder  $query
     * @return Builder
     * @noinspection PhpUnused
     */
    public function scopeActiveOrder(Builder $query): Builder
    {
        return $query->where('active_until', '>=', Carbon::today()->endOfDay());
    }
}
