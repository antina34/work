<?php /** @noinspection PhpMissingFieldTypeInspection */

namespace App\Models;

use BitPaySDKLight\Model\Currency;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static create(array $array)
 * @method static where(string $string, int $id)
 * @method static find(int $subscriptionId)
 * @method static updateOrCreate(int[] $array, int[] $array1)
 *
 * @property mixed product_id
 * @property mixed price
 * @property mixed days
 */
class SubscriptionPlan extends Model
{
    const SUBSCRIPTION_CURRENCY = Currency::USD;

    /**
     * @var string[]
     */
    protected $fillable = [
        'product_id',
        'price',
        'days',
    ];

    /**
     * The users that belong to the role.
     *
     * @return BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
