<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Photos extends Model
{
    protected $table = 'photos';
    protected $primaryKey = 'id';
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'gallery_id', 'path'
    ];

    /*
	|--------------------------------------------------------------------------
	| Scopes
	|--------------------------------------------------------------------------
	*/
	public function scopeOrderById($query, $order = 'DESC')
    {
        return $query->orderBy('id', $order);
    }

	public function scopeWhereGalleryId($query, $galleryId){
		return $query->where('gallery_id', $galleryId);
	}
}
