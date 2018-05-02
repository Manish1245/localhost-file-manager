<?php

$this->validate_request([
    "name" => "required"
]);

use Illuminate\Support\Facades\Storage;

$disk = Storage::disk("localhost");

$path = $this->input("path");
$name = $this->input("name");

$disk->makeDirectory("$path/$name");

$file['relative_path'] = "$path/$name";

$this->setData("file", $file);

$this->success("Folder Created");

