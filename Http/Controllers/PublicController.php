<?php

namespace Modules\Video\Http\Controllers;

//use Embed\Embed;
use Illuminate\Http\Response;
use Modules\Core\Http\Controllers\BasePublicController;
use Modules\Video\Repositories\CategoryRepository;
use Modules\Video\Repositories\MediaRepository;
use Breadcrumbs;

class PublicController extends BasePublicController
{
    /**
     * @var MediaRepository
     */
    private $media;
    private $per_page;
    /**
     * @var CategoryRepository
     */
    private $category;

    public function __construct(MediaRepository $media, CategoryRepository $category)
    {
        parent::__construct();

        $this->media = $media;
        $this->category = $category;

        $this->per_page = setting('video::per_page', $this->locale, 9);

        Breadcrumbs::register('video.index', function ($breadcrumbs) use ($media){
            $breadcrumbs->push(trans('themes::video.meta.title'), route('video.media.index'));
        });

    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
//        $embed = Embed::create('https://www.youtube.com/watch?v=BsekcY04xvQ');
//        dd($embed->getProviders()['html']->getBag()->get('videoid'));

        $medias = $this->media->paginate($this->per_page);

        $this->setTitle(trans('themes::video.meta.title'))
            ->setDescription(trans('themes::video.meta.desc'));

        $this->setUrl(route('video.media.index'))
            ->addMeta('robots', 'index, follow');

        return view('video::index', compact('medias'));
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function category($slug="")
    {
        $category = $this->category->findBySlug($slug);
        $medias = $category->medias()->orderBy('created_at', 'desc')->paginate($this->per_page);

        $this->setTitle(trans('themes::video.meta.title'))
            ->setDescription(trans('themes::video.meta.desc'));

        $this->setUrl(route('video.media.index'))
            ->addMeta('robots', 'index, follow');

        /* Start Breadcrumbs */
        Breadcrumbs::register('video.category', function ($breadcrumbs) use ($category) {
            $breadcrumbs->parent('video.index');
            $breadcrumbs->push($category->present()->meta_title, $category->url);
        });
        /* End Breadcrumbs */

        return view('video::category', compact('category', 'medias'));
    }

    public function show($slug)
    {
        $media = $this->media->findBySlug($slug);

        if(is_null($media)) app()->abort(404);

        $this->setTitle($media->title)
            ->setDescription($media->title);

        $this->setUrl($media->url)
            ->addMeta('robots', 'index, follow');

        Breadcrumbs::register('video.show', function ($breadcrumbs) use ($media){
            $breadcrumbs->parent('video.index');
            $breadcrumbs->push($media->category->title, $media->category->url);
            $breadcrumbs->push($media->title, $media->url);
        });

        return view('video::show', compact('media'));
    }
}
