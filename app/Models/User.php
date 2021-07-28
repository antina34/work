<?php

namespace App\Models;

use App\Traits\TimeTrait;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;

/**
 * @method static registeredToday()
 * @method static lastWeekRegistered()
 * @method static where(string $string, $userId)
 * @method static create(array $array)
 * @method static updateOrCreate(array $array, array $array1)
 * @property mixed|string name
 * @property mixed email
 * @property mixed|string password
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use TimeTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'telephone'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Scope a query to only include users who registered today
     *
     * @param  Builder $query
     * @return Builder
     */
    public function scopeRegisteredToday(Builder $query): Builder
    {
        return $query->where('created_at', '>=', Carbon::today());
    }

    /**
     * Scope a query to only include users who registered this week
     *
     * @param  Builder $query
     * @return Builder
     */
    public function scopeLastWeekRegistered(Builder $query): Builder
    {
        return $this->getScopeLastWeek($query);
    }
}
