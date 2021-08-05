<?php

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;
use Livewire\Commands\ComponentParser;
use Symfony\Component\Finder\Finder;

Route::middleware('web')->group(function () {
    $paths = Arr::wrap(config('laravel-livewire-routes.extra_paths'));
    $paths[] = ComponentParser::generatePathFromNamespace(config('livewire.class_namespace'));
    $finder = new Finder;

    foreach ($paths as $path) {
        if (!is_dir($path)) {
            continue;
        }

        foreach ($finder->in($path) as $file) {
            preg_match('/namespace (.*);/', $file->getContents(), $matches);

            optional($matches[1] ?? null, function (string $match) use ($file) {
                $class = str_replace('.php', '', $match . '\\' . $file->getFilename());
                if (method_exists($class, 'route')) {
                    optional(app($class)->route() ?? null, function ($route) use ($class) {
                        if (method_exists($route, 'uses')) {
                            $route->uses($class);
                        }
                    });
                }
            });
        }
    }
});
