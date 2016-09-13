<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ListingAttribute extends Model {

    /**
     * Generated
     */

    protected $table = 'listing_attributes';
    protected $fillable = ['id', 'listing_id', 'attribute_id', 'category_id', 'value'];


    public function listing() {
        return $this->belongsTo(\App\Models\Listing::class, 'listing_id', 'id');
    }

    public function attribute() {
        return $this->belongsTo(\App\Models\Attribute::class, 'attribute_id', 'id');
    }

    public function bussinessCategory() {
        return $this->belongsTo(\App\Models\BussinessCategory::class, 'category_id', 'id');
    }


}
