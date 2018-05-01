<?php

$this->validate_request([
    "path" => "required",
    "name" => "required",
//    "contents" => "required"
]);

use Illuminate\Support\Facades\Storage;

$disk = Storage::disk("localhost");

$path = $this->input("path");
$name = $this->input("name");

$disk->put("$path/$name", "");

$file['relative_path'] = "$path/$name";

$this->setData("file", $file);

$this->success("File Created");

