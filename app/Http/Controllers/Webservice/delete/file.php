<?php

use Illuminate\Support\Facades\Storage;

$disk = Storage::disk("localhost");

$paths = collect($this->input("paths"));

$path = $this->input("path");

if ($path) {
    $paths->push($path);
}

$total = $paths->count();

if (!$total) {
    $this->error("Please provide at least one path");
}

$paths->each(function($path) use($disk) {
    $disk->delete($path);
});

$this->success("$total File(s) Deleted");
