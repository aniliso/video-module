<?php

namespace Modules\Video\Services;

use File;
use Image;
use Embed\Embed;

class EmbedService
{
    private $width   = 400;
    private $height  = 200;
    private $mode    = 'fit';
    private $quality = 80;
    private $update = false;

    private $thumbFolder = 'thumbnail/';
    private $model;

    private $filename;
    private $thumbPrefix;
    private $thumbFilename;
    private $mediaFolderPath;
    private $thumbFolderPath;
    private $filePath;
    private $thumbFilePath;
    private $thumbUrl;


    public function __construct($model, $config=[])
    {
        if(count($config)>0) {
            $this->initialize($config);
        }

        $this->model             = $model;
        $this->thumbPrefix       = "{$this->width}_{$this->height}_{$this->mode}_{$this->quality}_";

        $this->mediaFolder         = config('asgard.video.config.files-path');

        $this->mediaFolderPath   = public_path($this->mediaFolder);
        $this->thumbFolderPath   = $this->mediaFolderPath.$this->thumbFolder;
    }

    private function initialize(array $config)
    {
        foreach ($config as $key => $val)
        {
            if(isset($this->{$key})) {
                $method = 'set'.ucfirst($this->{$key});
                if(method_exists($this, $method)) {
                    $this->{$method}($val);
                } else {
                    $this->{$key} = $val;
                }
                //Update thumb config
                if (array_key_exists($key, config('asgard.video.config.thumb'))) {
                    $this->{$key} = config('asgard.video.config.thumb.'.$key);
                }
            }
        }
    }

    private function checkFolders()
    {
        if( ! File::isDirectory($this->mediaFolderPath)) {
            File::makeDirectory($this->mediaFolderPath);
        }

        if( ! File::isDirectory($this->thumbFolderPath)) {
            File::makeDirectory($this->thumbFolderPath);
        }

        return File::exists($this->mediaFolderPath) && File::exists($this->mediaFolderPath) ? true : false;
    }

    public function update($check=true)
    {
        $this->update = $check;
        return $this;
    }

    public function getThumb()
    {
        try {
            $this->filename         = $this->model->embed['image'] ?? $this->model->id;
            $this->thumbFilename    = $this->thumbPrefix . $this->filename;

            $this->filePath         = $this->mediaFolderPath . $this->filename;
            $this->thumbFilePath    = $this->thumbFolderPath . $this->thumbFilename;

            $this->thumbUrl         = $this->mediaFolder . $this->thumbFolder . $this->thumbFilename;

            if ( ! File::exists($this->thumbFilePath)) {
                $image = Image::make($this->filePath);
                if($this->mode == 'fit') {
                    $image->fit($this->width, $this->height, function($constraint){
                        $constraint->upsize();
                    })->save($this->thumbFilePath, $this->quality);
                } elseif($this->mode == 'resize') {
                    $image->resize($this->width, $this->height, function($constraint){
                        $constraint->aspectRatio();
                    })->save($this->thumbFilePath, $this->quality);
                }
            }

            return $this->thumbUrl;
        }
        catch (\Exception $exception) {
            return null;
        }
    }

    public function getImageFromSource($file) {
        try {
            if($this->checkFolders()) {
                if(File::exists($this->filePath)) {
                    return $this->filename;
                } else {
                    $info = new \SplFileInfo($file);
                    $filename = "{$this->model->slug}_{$this->model->id}.{$info->getExtension()}";
                    Image::make($file)->save($this->mediaFolderPath.$filename);
                    return $filename;
                }
            }
        }
        catch (\Exception $exception) {

        }
    }

    public function createEmbed()
    {
        if($this->update) {
            $embed = Embed::create($this->model->video_link);
            if($embed->getImage()) {
                $filename = $this->getImageFromSource($embed->getImage());
                $this->model->update([
                    'embed' => [
                        'provider'    => $embed->getProviderName(),
                        'code'        => $embed->getCode(),
                        'source_image'=> $embed->getImage(),
                        'image'       => $filename,
                        'author'      => $embed->getAuthorName(),
                        'created_at'  => $embed->getPublishedTime(),
                        'aspectRatio' => $embed->getAspectRatio(),
                    ]
                ]);
                $this->update()->getThumb();
            }
        }
        return $this;
    }

    public function deleteEmbed() {
        return File::delete($this->filePath);
    }
}
