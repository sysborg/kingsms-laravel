<?php
namespace Sysborg\KingSMS\Channels;

use Illuminate\Notifications\Notification;
use Facades\Sysborg\KingSMS\Services\KingSMS;

class KingsmsChannel
{
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toKingsms($notifiable);
        $phone = $notifiable->routeNotificationForKingsms();
        KingSMS::sendSms($phone, $message);
    }
}
