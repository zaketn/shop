<?php

namespace App\Providers\Faker;

use Faker\Provider\Base;
use Illuminate\Support\Facades\Storage;

class FakerImageProvider extends Base
{
    /**
     * Генерирует пути для случайных файлов из папки /tests/Fixtures/images/$source в указанную директорию в public
     *
     * @param string $source
     * @param string $target
     * @return string
     */
    public function fixtures(string $source, string $target): string
    {
        $fixturesPath = base_path('/tests/Fixtures/images/') . $source;

        if (!Storage::exists($target)) {
            Storage::makeDirectory($target);
        }

        $file = fake()->file(
            $fixturesPath,
            storage_path("app/public/$target"),
            false
        );

        return '/storage/' . trim($source, '/') . '/' . $file;
    }
}
