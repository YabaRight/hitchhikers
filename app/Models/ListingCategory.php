<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ListingCategory extends Model {

    /**
     * Generated
     */

    protected $table = 'listing_categories';
    protected $fillable = ['id', 'listing_id', 'category_id'];


    public function listing() {
        return $this->belongsTo(\App\Models\Listing::class, 'listing_id', 'id');
    }

    public function category() {
        return $this->belongsTo(\App\Models\Category::class, 'category_id', 'id');
    }


}
