<?php /** @noinspection PhpMissingFieldTypeInspection */

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static ofActive()
 * @method static first()
 * @method static where(string $string, bool $true)
 * @method static withSubscriptions()
 * @method static find(int $id)
 * @method static create(array $all)
 * @method static get()
 * @method static updateOrCreate(string[] $array, string[] $array1)
 *
 * @property mixed id
 * @property mixed historical_url
 * @property mixed name
 * @property mixed actual_url
 * @property mixed show_last_nr
 * @property mixed active
 */
class Product extends Model
{
    public const DEFAULT_PRODUCT_ID = 1;

    protected $fillable = ['id', 'name', 'historical_url', 'actual_url', 'show_last_nr', 'active'];

    /**
     * The users that belong to the role.
     *
     * @return HasMany
     * @noinspection PhpUnused
     */
    public function subscriptions(): HasMany
    {
        return $this->hasMany(SubscriptionPlan::class);
    }

    /**
     * Scope a query to only include active product
     *
     * @param  Builder  $query
     * @return Builder
     * @noinspection PhpUnused
     */
    public function scopeOfActive($query): Builder
    {
        return $query->where('products.active', true);
    }

    /**
     * Scope a query to only include particular order status
     *
     * @param  Builder  $query
     * @return Builder
     * @noinspection PhpUnused
     */
    public function scopeWithSubscriptions($query): Builder
    {
        return $query->leftJoin(
            'subscription_plans',
            'subscription_plans.product_id',
            '=',
            'products.id'
        );
    }
}
