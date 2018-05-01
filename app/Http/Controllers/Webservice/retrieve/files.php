<?php

use Illuminate\Support\Facades\Storage;

$disk = Storage::disk("localhost");

$path = $this->input("path");

$search = $this->input("search");

$offset = $this->input("offset") ?: 0;
$limit = $this->input("limit") ?: 10;

$directories = collect($disk->directories($path));
$files = collect($disk->files($path));
$allFiles = $directories->merge($files)->filter(function($path) use($search) {
            $name = basename($path);
            if ($search) {
                if (str_contains($name, $search)) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return true;
            }
        })->map(function($name) use($path, $disk) {
    $path = $disk->getAdapter()->getPathPrefix() . $name;
    $data['name'] = basename($name);
    $data['relative_path'] = $name;
    $data['path'] = $path;
    $data['url'] = $disk->url($name);
    $data['mime'] = $disk->mimeType($name);
    $data['extension'] = pathinfo($path, PATHINFO_EXTENSION);
    $data['is_dir'] = is_dir($path);
    $data['is_editable'] = !is_dir($path);
    if ($data['is_dir']) {
        $data['icon']['classes'] = "fa-folder";
    } else {
        $data['icon']['classes'] = "fa-file";
    }
    $data['is_image'] = preg_match("/^image\/*$/", $data['mime']);
    return (object) $data;
});

$this->setData("total_files", $files->count());
$this->setData("total_directories", $directories->count());
$this->setData("files", $allFiles);
