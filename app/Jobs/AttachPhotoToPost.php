<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use \Storage;

use App\Post;

class AttachPhotoToPost implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $post;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $hash = $this->post->photoHash();
        $filename = $this->post->photoFilename();

        // download a photo if one with the same filename doesn't exist already
        if (!Storage::exists($filename)) {
            // get a random photo from picsum
            $url = "https://picsum.photos/seed/{$hash}/128";
            $image = file_get_contents($url);
            Storage::put($filename, $image, 'public');
            info("Downloaded new photo [{$url}]; post_id={$this->post->id}");
        } else {
            info("Using existing photo [{$filename}]; post_id={$this->post->id}");
        }
        
        // store the new photo in the database
        $this->post->photo = $filename;
        $this->post->save();

        info("Attached photo [{$filename}]; post_id={$this->post->id}");
    }
}
