<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class GeneratePost extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate:post {--n=1 : the amount of posts to generate}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate and insert random posts';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $n = $this->option('n');
        $this->info("Generating {$n} " . Str::plural('post', $n));
        factory(\App\Post::class, (int) $n)->create();
    }
}
