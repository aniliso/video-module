<?php

namespace Modules\Video\Http\Controllers\Api;

use Illuminate\Http\Request;
use Embed\Embed;
use Illuminate\Http\Response;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;
use Modules\Video\Repositories\MediaRepository;

class MediaController extends AdminBaseController
{
    /**
     * @var MediaRepository
     */
    private $media;

    public function __construct(MediaRepository $media)
    {
        parent::__construct();
        $this->media = $media;
    }

    public function get(Request $request)
    {
        try
        {
            if($request->has('id')) {
                $id = $request->get('id');
                if($media = $this->media->find($id)) {
                    return response()->json([
                        'success' => true,
                        'data'    => $media
                    ], Response::HTTP_OK);
                } else {
                    throw new \Exception('Video bulunamadı');
                }
            } else {
                throw new \Exception('Hata! Video ID alınamadı.');
            }
        }
        catch (\Exception $exception)
        {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }
    }
    public function getEmbed(Request $request)
    {
        try {
            $url = $request->get('url');
            $embed = Embed::create($url);
            if($embed->getCode()) {
                return response()->json([
                    'success' => true,
                    'data'    => [
                        'title'        => $embed->getTitle(),
                        'slug'         => str_slug($embed->getTitle()),
                        'description'  => $embed->getDescription(),
                        'code'         => $embed->getCode()
                    ]
                ], Response::HTTP_OK);
            } else {
                throw new \Exception('Video mevcut değil');
            }
        }
        catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage()
            ] , Response::HTTP_BAD_REQUEST);
        }
    }
}
