<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model {

    /**
     * Generated
     */

    protected $table = 'attributes';
    protected $fillable = ['id', 'name', 'description', 'bussiness_category_id'];


    public function bussinessCategory() {
        return $this->belongsTo(\App\Models\BussinessCategory::class, 'bussiness_category_id', 'id');
    }


}
