<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Post;

class RemoveStalePosts implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $cutoff = now()
            ->subHours(1)
            ->toDateTimeString();
        $posts = Post::where('created_at', '<=', $cutoff)->get();

        if (count($posts) == 0) {
            info("No stale posts to remove.");
            return;
        }

        // we want to delete unused photos
        // some posts may use the same photo so we want to only removed the ones
        // that are no longer used by any posts
        $postPhotos = $posts
            ->pluck('photo')
            ->whereNotNull()
            ->unique()
            ->toArray();
        $postIds = $posts->pluck('id');

        $countPosts = Post::whereIn('id', $postIds)->delete();
        info("Removed {$countPosts} stale posts.");

        // find the photos that are still used
        // and take them out of the array of photos to delete
        $usedPhotos = Post::whereIn('photo', $postPhotos)
            ->get()
            ->pluck('photo')
            ->unique()
            ->toArray();
        $unusedPhotos = array_diff($postPhotos, $usedPhotos);
        $countUnusedPhotos = count($unusedPhotos);

        info("Identified {$countUnusedPhotos} unused photos.");
        if (count($unusedPhotos) > 0) {
            RemovePhotos::dispatch(array_values($unusedPhotos));
            info("Scheduled removal of {$countUnusedPhotos} unused photos.");
        }
    }
}
