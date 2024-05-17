<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class ProductCategory extends Model
{
    use HasFactory, Sluggable, HasSlug;

    protected $guarded = ['id'];

    public function Posts()
    {
        return $this->hasMany(ProductItem::class);
    }

    public function getRouteKey()
    {
        return 'slug';
    }

    public function sluggable(): array
    {
        return [
            'slug'  => [
                'source' => 'name',
            ]
        ];
    }

    public function getSlugOptions() : SlugOptions
     {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

}
