<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HitCount extends Model {

    /**
     * Generated
     */

    protected $table = 'hit_counts';
    protected $fillable = ['id', 'listing_id', 'hits'];


    public function listing() {
        return $this->belongsTo(\App\Models\Listing::class, 'listing_id', 'id');
    }


}
