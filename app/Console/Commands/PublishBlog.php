<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Post;

class PublishBlog extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'publish:blog';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to publish drafted blogs';

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
        $posts = Post::isDraft()->isNotPublished()->publishedTimePast()->get();
        foreach ($posts as $key => $post) {
            $post->is_published = 1;
            $post->save();
        }

        if(!$posts->isEmpty())
            $this->info('Posts has been published with time '. \Carbon\Carbon::now());

    }
}
