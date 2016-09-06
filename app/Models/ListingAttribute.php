<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ListingAttribute extends Model {

    /**
     * Generated
     */

    protected $table = 'listing_attributes';
    protected $fillable = ['id', 'listing_id', 'category_id', 'value'];


    public function listing() {
        return $this->belongsTo(\App\Models\Listing::class, 'listing_id', 'id');
    }

    public function category() {
        return $this->belongsTo(\App\Models\Category::class, 'category_id', 'id');
    }


}
