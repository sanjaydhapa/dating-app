<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Story;
use Illuminate\Support\Facades\Storage;
class DeleteExpiredStories extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stories:cleanup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete stories that have expired (after 24 hours)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $expiredStories = Story::where('expires_at', '<', now())->get();
        dd($expiredStories);
        foreach ($expiredStories as $story) {
            // Delete media file from storage
            if ($story->media_url) {
                $path = str_replace('/storage/', '', $story->media_url);
                Storage::disk('public')->delete($path);
            }

            // Delete story from database
            $story->delete();
        }

        $this->info("Expired stories cleaned up successfully.");
    }
}
