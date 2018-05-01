<?php

$this->validate_request([
    "relative_path" => "required",
//    "contents" => "required"
]);

use Illuminate\Support\Facades\Storage;

$disk = Storage::disk("localhost");

$path = $this->input("relative_path");
$contents = $this->input("contents");

$disk->put($path, $contents);

$this->success("File Saved");
