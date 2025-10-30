<?php
namespace Sysborg\KingSMS\Channels;

use Illuminate\Notifications\Notification;
use Facades\Sysborg\KingSMS\Services\KingSMS;
use Illuminate\Notifications\AnonymousNotifiable;

class KingsmsChannel
{
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toKingsms($notifiable);
        if ($notifiable instanceof AnonymousNotifiable) {
            $phone = $notifiable->routes['kingsms'];
        } else {
            $phone = $notifiable->routeNotificationForKingsms();
        }

        KingSMS::sendSms($phone, $message);
    }
}
