<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;


class CollectionPoint extends Model
{
    

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'collection_point_category');
    }

    protected function openFrom(): Attribute
    {
        return Attribute::make(
            get: fn($value) => Carbon::createFromFormat('H:i:s', $value)->format('H:i')
        );
    }

    protected function openTo(): Attribute
    {
        return Attribute::make(
            get: fn($value) => Carbon::createFromFormat('H:i:s', $value)->format('H:i')
        );
    }
}
