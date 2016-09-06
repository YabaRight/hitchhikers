<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {

    /**
     * Generated
     */

    protected $table = 'categories';
    protected $fillable = ['id', 'name', 'description'];


    public function listings() {
        return $this->belongsToMany(\App\Models\Listing::class, 'listing_attributes', 'category_id', 'listing_id');
    }

    public function listings() {
        return $this->belongsToMany(\App\Models\Listing::class, 'listing_categories', 'category_id', 'listing_id');
    }

    public function listingAttributes() {
        return $this->hasMany(\App\Models\ListingAttribute::class, 'category_id', 'id');
    }

    public function listingCategories() {
        return $this->hasMany(\App\Models\ListingCategory::class, 'category_id', 'id');
    }


}
