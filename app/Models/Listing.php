<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Listing extends Model {

    /**
     * Generated
     */

    protected $table = 'listings';
    protected $fillable = ['id', 'name', 'description', 'address', 'phone', 'x_coordinate', 'y_coordinate', 'email', 'twitter', 'facebook', 'instagram', 'hours', 'url', 'has_attributes', 'image'];


    public function categories() {
        return $this->belongsToMany(\App\Models\Category::class, 'listing_attributes', 'listing_id', 'category_id');
    }

    public function categories() {
        return $this->belongsToMany(\App\Models\Category::class, 'listing_categories', 'listing_id', 'category_id');
    }

    public function listingAttributes() {
        return $this->hasMany(\App\Models\ListingAttribute::class, 'listing_id', 'id');
    }

    public function listingCategories() {
        return $this->hasMany(\App\Models\ListingCategory::class, 'listing_id', 'id');
    }


}