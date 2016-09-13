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

    public function bussinessCategory() {
        return $this->belongsTo(\App\Models\BussinessCategory::class, 'category_id', 'id');
    }


}
