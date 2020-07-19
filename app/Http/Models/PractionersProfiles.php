<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PractionersProfiles extends Model
{
	use SoftDeletes;

    protected $table = 'practitioners_profiles';
    protected $primaryKey = 'id';
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'profile_photo', 'phone_number', 'email', 'category_id', 'location_id', 'gallery_id'
    ];

     /*
	|--------------------------------------------------------------------------
	| Scopes
	|--------------------------------------------------------------------------
	*/

	public function scopeWhereGalleryId($query, $galleryId){
		return $query->where('gallery_id', $galleryId);
	}

	public function scopeOrderById($query, $order = 'DESC')
    {
        return $query->orderBy('id', $order);
    }

    public function scopeWhereNameLike($query, $keyword)
    {
        return $query->where('name', 'LIKE', '%'. $keyword . '%');
    }

    public function scopeWhereCategoryId($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }

    public function scopeWhereLocationId($query, $locationId)
    {
        return $query->where('location_id', $locationId);
    }

    /*
    |--------------------------------------------------------------------------
    | Relations
    |--------------------------------------------------------------------------
    */

    public function gallery()
    {
        return $this->hasOne('App\Http\Models\Gallery', 'id', 'gallery_id');
    }


    public function locations()
    {
        return $this->hasOne('App\Http\Models\Locations', 'id', 'location_id');
    }
}
