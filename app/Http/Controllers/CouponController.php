<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function validateCoupon(Request $request)
    {
        $couponCode = $request->input('couponCode');
        $coupon = Coupon::where('discount_code', $couponCode)->first();

        if ($coupon && $coupon->frequency > 0) {
            return response()->json([
                'valid' => true,
                'discount' => $coupon->discount,
                'frequency' => $coupon->frequency,
            ]);
        }

        return response()->json(['valid' => false]);
    }

    public function updateFrequency($couponCode)
    {

        // Log the couponCode for debugging
        $coupon = Coupon::where('discount_code', $couponCode)->first();

        if ($coupon === null) {
            return; // Coupon not found, return without any further action
        }

        if ($coupon->frequency > 0) {
            $coupon->decrement('frequency');
        }
    }
}
