<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Jobs\SimularHeartbeats;
use App\Jobs\DetectarCaidas;
use Illuminate\Support\Facades\Schedule;

Schedule::job(new SimularHeartbeats())->everyMinute();
Schedule::job(new DetectarCaidas())->everyMinute();

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');
