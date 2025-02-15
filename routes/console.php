<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('books:auto-return')->dailyAt('00:00');
