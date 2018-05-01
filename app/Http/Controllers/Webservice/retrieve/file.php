<?php

use Illuminate\Support\Facades\Storage;

$disk = Storage::disk("localhost");

$path = $this->input("path");

$contents = $disk->get($path);

$ace_modes = [
    "js" => "javascript"
];

$ext = pathinfo($path, PATHINFO_EXTENSION);

$file['relative_path'] = $path;
$file['url'] = $disk->url($path);
$file['contents'] = $contents;
$file['ace_mode'] = array_get($ace_modes, $ext) ?: $ext;

$this->setData("file", $file);
