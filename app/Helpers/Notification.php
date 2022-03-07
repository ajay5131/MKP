<?php 

namespace App\Helpers;
use App\Models\Frontend\Notifications;

class Notification {

    // sender, receiver, type, media_id, media_table,status, 
    public static function send($data) {
        Notifications::create($data);
    }
}
