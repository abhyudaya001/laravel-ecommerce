<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
class Coupon extends Model
{
    use HasFactory;
    protected $fillable = [
        'discount_code',
        'discount',
        'frequency',
    ];


    public function items(): int
    {
        return Coupon::count();
    }

}
