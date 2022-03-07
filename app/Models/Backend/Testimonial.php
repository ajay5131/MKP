<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
	protected $table = 'testimonials';
    protected $fillable = [
        'full_name','full_name_fr', 'profession', 'profession_fr', 'media', 'tag_id', 'testimonial', 'testimonial_fr'
    ];
    public $timestamps = true;
    protected $dates = ['created_at', 'updated_at'];

}
