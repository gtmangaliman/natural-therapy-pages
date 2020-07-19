<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table = 'gallery';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $appends = ['photo_list'];

      /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'status'
    ];

    /*
    |--------------------------------------------------------------------------
    | Getters and Setters
    |--------------------------------------------------------------------------
    */
    public function getPhotoListAttribute()
    {
        return count($this->photos) ? $this->photos : null;
    }

    /*
	|--------------------------------------------------------------------------
	| Relations
	|--------------------------------------------------------------------------
	*/
    public function photos()
	{
		return $this->hasMany('App\Http\Models\Photos', 'gallery_id', 'id')->orderById();
	}
}
