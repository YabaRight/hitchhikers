<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BussinessCategory extends Model {

    /**
     * Generated
     */

    protected $table = 'bussiness_categories';
    protected $fillable = ['id', 'name', 'description'];


    public function listing_attributes() {
        return $this->belongsToMany(\App\Models\Listing::class, 'listing_attributes', 'category_id', 'listing_id');
    }

    public function listing_categories() {
        return $this->belongsToMany(\App\Models\Listing::class, 'listing_categories', 'category_id', 'listing_id');
    }

    public function attributes() {
        return $this->hasMany(\App\Models\Attribute::class, 'bussiness_category_id', 'id');
    }

    public function listingAttributes() {
        return $this->hasMany(\App\Models\ListingAttribute::class, 'category_id', 'id');
    }

    public function listingCategories() {
        return $this->hasMany(\App\Models\ListingCategory::class, 'category_id', 'id');
    }


}
