<?php
namespace App\Services;

use Illuminate\Support\Facades\Storage;

// TODO: find a way to encrypt the downloaded files end to end
/**
 *  Overall logic should be the following:
 *  - Whenever a new patch comes out, we should create a manifest file that contains the checksum of all the files in the patch, and the version number, this should be run only ONCE to avoid unnecessary overhead
 *  - The server should then store the manifest file and the patch files in a directory
 *  - The client should then download the manifest file, check the server version against its own version, if it's normal
 *  - Whenever a user wants to check if their files are up to date, they should send a request to the server with the checksum of their files, the server should then compare the checksums and return a list of files that are out of date
 *  - The client should then download the files that are out of date
 **/
class Manifest
{
    public static function getFileManifestData(string $path)
    {
        $data = [
            // remove patchdata/ from the path
            'path' => substr($path, 10),
            'size' => Storage::disk('local')->size($path),
            'checksum' => hash_file('sha1', Storage::disk('local')->path($path)),
        ];
        return $data;
    }
    public static function getManifest()
    {
        $contents = Storage::disk('public')->get('manifest.txt');
        return json_decode($contents, true);
    }

}
