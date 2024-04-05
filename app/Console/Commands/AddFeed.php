<?php

namespace App\Console\Commands;

use App\Models\Feed;
use Illuminate\Console\Command;

class AddFeed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'feed:add {title} {url}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new feed';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Feed::create([
            'title' => $this->argument('title'),
            'url' => $this->argument('url'),
        ]);

        $this->info("Nouveau feed ajouté : " . $this->argument('title'));
    }
}
