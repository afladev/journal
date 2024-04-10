<?php

use App\Console\Commands\FetchPostsUsingFeed;
use Illuminate\Support\Facades\Schedule;

Schedule::command(FetchPostsUsingFeed::class)->hourly();
