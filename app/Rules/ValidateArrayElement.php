<?php
namespace App\Rules;
use Illuminate\Contracts\Validation\Rule;
class ValidateArrayElement implements Rule
{
    
    public function __construct()
    {
    }
    
    public function passes($attribute, $value)
    {
            return !empty($value[0]);
    }
    
    public function message()
    {
        return 'At least one :attribute is required!';
    }
}