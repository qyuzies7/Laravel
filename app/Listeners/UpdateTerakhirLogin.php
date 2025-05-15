<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;

class UpdateTerakhirLogin
{
    public function handle(Login $event): void
    {
        if ($event->user instanceof \App\Models\Pengguna) {
            $event->user->update([
                'terakhir_login' => now(),
            ]);
        }
    }
}
