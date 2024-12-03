<?php

namespace App\Jobs;

use App\Services\Manifest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class Checksum implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    private $version;

    public function __construct(string $version)
    {
        $this->version = $version;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Manifest will be output in txt as path:checksum:size
        $patchFiles = Storage::disk('local')->allFiles('patchdata');
        $manifest = 'v' . $this->version . PHP_EOL;
        foreach ($patchFiles as $file) {
            $data = Manifest::getFileManifestData($file);
            $manifest .= $data['path'] . ':' . $data['checksum'] . ':' . $data['size'] . PHP_EOL;
        }
        Storage::disk('public')->put('manifest.txt', $manifest);
    }
}
