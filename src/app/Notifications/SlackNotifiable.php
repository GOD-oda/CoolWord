<?php

declare(strict_types=1);

namespace App\Notifications;

use Illuminate\Notifications\RoutesNotifications;

trait SlackNotifiable
{
    use RoutesNotifications;

    public function routeNotificationForSlack(): string
    {
        return config('services.slack.web_hook_url');
    }
}
