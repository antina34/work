<?php /** @noinspection PhpMissingFieldTypeInspection */

namespace App\Models;

use App\Traits\HasTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string external_id
 * @property string currency
 * @property float price
 * @property boolean is_test
 * @property string status
 * @property string invoice_time
 * @property string expiration_time
 * @property string current_time_string
 * @property mixed buyer_provided_email
 * @property mixed transaction_currency
 * @property mixed amount_paid
 *
 * @method static updateOrCreate(array $array, array $array1)
 * @method static findOrFail(int $id)
 * @method static select(string[] $array)
 * @method where(string $string, string $string1, $getId)
 * @method static ofUser($userId)
 */
class Invoice extends Model
{
    use HasTime;

    const DATE_FORMAT = 'Y-m-d';
    const DATE_TIME_FORMAT = 'Y-m-d H:i:s';
    const TIME_FORMAT = 'H:i:s';

    const STATUS_NEW = 'new';
    const STATUS_EXPIRED = 'expired';
    const STATUS_PAID = 'paid';
    const STATUS_COMPLETE = 'complete';
    const STATUS_CONFIRMED = 'confirmed';

    /**
     * @var array
     */
    protected $fillable = [
        'external_id',
        'order_id',
        'currency',
        'price',
        'is_test',
        'status',
        'invoice_time',
        'expiration_time',
        'current_time_string',
        'buyer_provided_email',
        'transaction_currency',
        'amount_paid'
    ];

    /**
     * The invoice belongs to an order.
     *
     * @return BelongsTo
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
