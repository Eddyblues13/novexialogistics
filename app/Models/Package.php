<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_name',
        'sender_address',
        'sender_city',
        'sender_state',
        'sender_zip',
        'sender_country',
        'sender_phone',
        'sender_email',
        'receiver_name',
        'receiver_address',
        'receiver_city',
        'receiver_state',
        'receiver_zip',
        'receiver_country',
        'receiver_phone',
        'receiver_email',
        'tracking_number',
        'item_description',
        'item_quantity',
        'declared_value',
        'total_weight',
        'number_of_boxes',
        'box_weight',
        'shipping_from',
        'shipping_to',
        'shipping_date',
        'estimated_delivery_date',
        'current_step',
        'progress_percentage',
        'step1_name',
        'step1_date',
        'step2_name',
        'step2_date',
        'step3_name',
        'step3_date',
        'step4_name',
        'step4_date',
        'notes',
        'image_url',
        'image_public_id',
        'video_url',
        'video_public_id'
    ];


    protected $casts = [
        'shipping_date' => 'datetime',
        'estimated_delivery_date' => 'datetime',
        'step1_date' => 'datetime',
        'step2_date' => 'datetime',
        'step3_date' => 'datetime',
        'step4_date' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];



    public function trackingLocations()
    {
        return $this->hasMany(TrackingLocation::class);
    }



    public function updateProgress($step)
    {
        $this->current_step = $step;
        $this->progress_percentage = $step * 25;

        $stepDateField = "step{$step}_date";
        if (empty($this->$stepDateField)) {
            $this->$stepDateField = now();
        }

        $this->save();
    }
}
