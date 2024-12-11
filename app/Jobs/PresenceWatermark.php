<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class PresenceWatermark implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $files = Storage::disk('public')->files('rcp-areas');
        $manager = new ImageManager(new Driver());
        $watermark = $manager->read(storage_path('app/private/title.png'));
        if(!Storage::disk('public')->exists('watermark/rcp-areas')){
            Storage::disk('public')->makeDirectory('watermark/rcp-areas');
        }
        foreach($files as $file){
            if(Storage::disk('public')->exists('watermark/'.$file)){
                continue;
            }
            $image = $manager->read(storage_path('app/public/'.$file));
            $image->place($watermark, 'top-right', 10, -100);
            $image->save(storage_path('app/public/watermark/'.$file));
        }
    }
}
