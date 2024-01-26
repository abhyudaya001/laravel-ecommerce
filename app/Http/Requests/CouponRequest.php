<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
{
    public function authorize()
    {
        return true; // You can define authorization logic here if needed.
    }

    public function rules()
    {
        return [
            'discount_code' => 'required|string|max:255', // Modify as needed
            'discount' => 'required|numeric', // Set the maximum value to 99
            'frequency' => 'required|integer', // Ensure it's an integer
        ];
    }
}
