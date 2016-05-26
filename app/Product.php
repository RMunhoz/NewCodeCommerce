<?php

namespace CodeCommerce;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id',
    	'name',
    	'description',
    	'price',
    	'featured',
    	'recommend'
    ];

    public function images()
    {
        return $this->hasMany('CodeCommerce\ProductImage');
    }

    public function category()
    {
    	return $this->belongsTo('CodeCommerce\Category');
    }

    public function tags()
    {
        return $this->belongsToMany('CodeCommerce\Tag');
    }

    public function getTagListAttribute()
    {
        $tags = $this->tags->lists('name')->toArray();
        return implode(', ', $tags);
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured','=','1')->limit(3);
    }

    public function scopeRecommend($query)
    {
        return $query->where('recommend','=','1')->orderBy('price')->limit(3);
    }

    public function scopeFindCategory($query, $type)
    {
        return $query->where('category_id', '=', $type);
    }

    public function  scopeOfTag($query, $type)
    {
        return $query->where('tag_id', '=', $type);
    }
}
