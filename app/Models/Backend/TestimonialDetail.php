<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

class TestimonialDetail extends Model
{
	protected $table = 'testimonials_detail';
    protected $fillable = [
        'language_id', 'testimonials_id', 'full_name','testimonial', 'profession'
    ];
    public $timestamps = false;

}
