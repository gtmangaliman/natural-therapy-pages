<?php

namespace App\Http\Helpers;

class PhotoHelper {

	private $publicPath;
	private $imagesPath;

	public function __construct()
	{
		$this->publicPath = base_path().'/public';
		$this->imagesPath = '/images';
	}

	public function getDetails($file, $path)
	{
    	$name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();
        $photoName = StringHelper::cleanUp($name, '-').'-'.time().'.'.strtolower($extension);
        $photoBasePath = $this->imagesPath.$path;

        return [
        	'basePath' => $this->publicPath.$photoBasePath,
        	'path' => $photoBasePath.$photoName,
        	'name' => $photoName
        ];
	}

	public function savePhoto($file, $path, $name)
	{
		$file->move($path, $name);
	}
}
