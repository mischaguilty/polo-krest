<?php


namespace App\Traits;


trait HasPositions
{
    public function sortUp($id)
    {
        if ($model = self::query()->firstWhere([
            'id' => $id,
        ])) {
            optional($model->decrement('position'));
        }
    }

    public function sortDown($id)
    {
        if ($model = self::query()->firstWhere([
            'id' => $id,
        ])) {
            optional($model->increment('position'));
        }
    }
}
