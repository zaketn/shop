<?php

namespace App\Traits\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait HasSlug
{
    protected static function bootHasSlug(): void
    {
        static::creating(function (Model $model) {
            $model->slug = self::generateSlug($model);
        });
    }

    /**
     * Генерирует уникальное slug поле
     *
     * @param Model $model
     * @param int $duplicateCounter
     * @return string
     */
    private static function generateSlug(Model $model, int $duplicateCounter = 0) : string
    {
        $sSlug = $model->slug ?? Str::slug($model->{self::slugField()});
        if($duplicateCounter > 0){
            $sSlug = $sSlug . '-' . $duplicateCounter;
        }

        $bIsSlugsDuplicates = $model->query()
            ->where('slug', $sSlug)
            ->count();

        if($bIsSlugsDuplicates){
            $duplicateCounter += 1;
            return self::generateSlug($model, $duplicateCounter);
        }

        return $sSlug;
    }

    private static function slugField() : string
    {
        return 'title';
    }
}
