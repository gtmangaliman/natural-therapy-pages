<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Helpers\StringHelper;
use App\Http\Helpers\StatusHelper as STATUS;
use App\Http\Helpers\PhotoHelper;
use App\Http\Models\PractionersProfiles;
use App\Http\Models\Gallery;
use App\Http\Models\Photos;
use Illuminate\Support\Arr;

class PractitionersController extends Controller
{
	private $profilePhotoPath;
	private $galleryPhotoPath;

	public function __construct()
	{
		$this->middleware('auth', ['only' => [
				'store',
				'update',
				'destroy'
			]
		]);

		$this->profilePhotoPath = '/profile-photos/';
		$this->galleryPhotoPath = '/gallery/';
	}

	public function index($page, $limit, Request $request, PractionersProfiles $practitioners)
	{
		$data = [];

		$page = (int) $page;

		$skip = $page * $limit;

		$name = $request->input('name');
		$categoryId = $request->input('category_id');
		$locationId = $request->input('location_id');
		$sort = $request->input('sort', 'DESC');

		if ($name) {
			$practitioners = $practitioners->whereNameLike($name);
		}

		if ($categoryId) {
			$practitioners = $practitioners->whereCategoryId($categoryId);
		}

		if ($locationId) {
			$practitioners = $practitioners->whereLocationId($locationId);
		}

		$practitioners = $practitioners->orderById($sort)->skip($skip)->take($limit)->get();

		foreach ($practitioners as $key => $value) {

			$data[]	= Arr::only($value->toArray(), ['id', 'name', 'description', 'profile_photo', 'phone_number', 'email']);

			$data[$key]['location'] = isset($value->locations) ? $value->locations->name : NULL;

			$photos = isset($value->gallery['photo_list']) ? array_map(function($item){
	                   return [
	  							'id' => $item['id'],
	  							'path' => $item['path']
	  						];
	                    }, $value->gallery['photo_list']->toArray()) : NULL;

			$data[$key]['gallery'] = isset($value->gallery) ? [
				'id' => $value->gallery['id'],
				'title' => $value->gallery['title'],
				'photos' => $photos
			] : NULL;
		}

		return response()->json($data, 200, [], JSON_NUMERIC_CHECK);
	}

    public function store(Request $request)
    {
    	$profilePhoto = $request->file('profile_photo');

        $photoHelper = new PhotoHelper;

        if ($profilePhoto) {
        	$photo = $photoHelper->getDetails($profilePhoto, $this->profilePhotoPath);
        	$photoHelper->savePhoto($profilePhoto, $photo['basePath'], $photo['name']);
        }

        $data = Arr::except($request->all(), ['api_token', 'profile_photo']);
        $data['profile_photo'] = isset($photo) ? $photo['path'] : NULL;

        $profile = PractionersProfiles::create($data);
        $profile->save();

        if (isset($data['gallery'])) {
        	$galleryDtls = $data['gallery'];

        	$gallery = Gallery::create([
        		'title' => $galleryDtls['title'],
        		'status' => STATUS::ACTIVE
        	]);
        	$gallery->save();

        	$profile->gallery_id = $gallery->id;
        	$profile->save();

        	$files = $request->file('gallery');
        	if (isset($files['photos'])) {
        		foreach ($files['photos'] as $key => $photo) {
		    		$galleryPhoto = $photoHelper->getDetails($photo, $this->galleryPhotoPath);
		    		$photoHelper->savePhoto($photo, $galleryPhoto['basePath'], $galleryPhoto['name']);

		    		$photos = Photos::create([
		    			'gallery_id' => $gallery->id,
		    			'path' => $galleryPhoto['path']

		    		]);

		    		$photos->save();
		    	}
        	}
        }

    	 return response()->json([
    	 	'success' => true,
    	 	'message' => 'practitioner\'s data was successfully created',
    	 	'data' => $data
    	 ]);
    }

    public function update(Request $request)
    {
    	$id = $request->input('id');
    	$practitioner = PractionersProfiles::find($id);

    	if ($practitioner) {
    		$profilePhoto = $request->file('profile_photo');

    		$photoHelper = new PhotoHelper;

	        if ($profilePhoto) {
	        	$photo = $photoHelper->getDetails($profilePhoto, $this->profilePhotoPath);
	        	$photoHelper->savePhoto($profilePhoto, $photo['basePath'], $photo['name']);
	        }

    		$data = Arr::except($request->all(), ['api_token', 'profile_photo']);
    		$practitioner->update($data);

    		if (isset($data['gallery']) && isset($data['gallery']['id'])) {
	        	$galleryDtls = $data['gallery'];

	        	$gallery = Gallery::find($galleryDtls['id']);

	        	if ($gallery) {
	        		$gallery->update($galleryDtls);
	        	}

	        	$files = $request->file('gallery');
	        	if (isset($files['photos'])) {
	        		foreach ($files['photos'] as $key => $photo) {
			    		$galleryPhoto = $photoHelper->getDetails($photo, $this->galleryPhotoPath);
			    		$photoHelper->savePhoto($photo, $galleryPhoto['basePath'], $galleryPhoto['name']);

			    		$photos = Photos::create([
			    			'gallery_id' => $gallery->id,
			    			'path' => $galleryPhoto['path']

			    		]);

			    		$photos->save();
			    	}
	        	}
	        }

	    	return response()->json([
	    	 	'success' => true,
	    	 	'message' => 'practitioner\'s data was successfully updated',
	    	 	'data' => $data
	    	]);
    	} else {
    		return response()->json([
	    	 	'success' => false,
	    	 	'message' => 'the practioner you\'re trying to update does not exist.'
	    	 ]);
    	}
    }

    public function destroy(Request $request)
    {
    	$id = $request->input('id');
    	$practitioner = PractionersProfiles::find($id);

    	if ($practitioner) {
    		$galleryId = $practitioner['gallery_id'];

    		if ($galleryId) {
    			$photos = Photos::whereGalleryId($galleryId);
	    		$photos->delete();

	    		$gallery = Gallery::find($galleryId);
	    		$gallery->delete();
    		}

    		$practitioner->delete();

    		return response()->json([
	    	 	'success' => true,
	    	 	'message' => 'practitioner\'s data was successfully deleted'
	    	]);
    	} else {
    		return response()->json([
	    	 	'success' => false,
	    	 	'message' => 'the practioner you\'re trying to delete does not exist.'
	    	 ]);
    	}
    }
}
