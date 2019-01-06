<?php

namespace Modules\Video\Http\Controllers\Admin;

use Datatables;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Video\Entities\Media;
use Modules\Video\Http\Requests\CreateMediaRequest;
use Modules\Video\Http\Requests\UpdateMediaRequest;
use Modules\Video\Repositories\CategoryRepository;
use Modules\Video\Repositories\MediaRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class MediaController extends AdminBaseController
{
    /**
     * @var MediaRepository
     */
    private $media;
    /**
     * @var CategoryRepository
     */
    private $category;

    public function __construct(MediaRepository $media, CategoryRepository $category)
    {
        parent::__construct();

        $this->media = $media;
        $this->category = $category;

        view()->share('categories', $this->category->all()->pluck('title', 'id')->toArray());
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $medias = $this->media->allWithBuilder()->with(['translations','category']);
        if(request()->ajax()) {
            return Datatables::of($medias)
                ->addColumn('category', function ($media) {
                    return isset($media->category->title) ? $media->category->title : '';
                })
                ->editColumn('status', function ($media){
                    return $media->status ? 'Yayında' : 'Yayında Değil';
                })
                ->addColumn('action', function ($media) {
                    $action_buttons =   \Html::decode(link_to(
                        route('admin.video.media.edit',
                            [$media->id]),
                        '<i class="fa fa-pencil"></i>',
                        ['class'=>'btn btn-default btn-flat']
                    ));
                    $action_buttons .=  \Html::decode(\Form::button(
                        '<i class="fa fa-trash"></i>',
                        ["data-toggle" => "modal",
                         "data-action-target" => route("admin.video.media.destroy", [$media->id]),
                         "data-target" => "#modal-delete-confirmation",
                         "class"=>"btn btn-danger btn-flat"]
                    ));
                    return $action_buttons;
                })
                ->escapeColumns([])
                ->make(true);
        }

        return view('video::admin.media.index', compact('media'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('video::admin.media.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateMediaRequest $request
     * @return Response
     */
    public function store(CreateMediaRequest $request)
    {
        $this->media->create($request->all());

        return redirect()->route('admin.video.media.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('video::media.title.media')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Media $media
     * @return Response
     */
    public function edit(Media $media)
    {
        return view('video::admin.media.edit', compact('media'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Media $media
     * @param  UpdateMediaRequest $request
     * @return Response
     */
    public function update(Media $media, UpdateMediaRequest $request)
    {
        $this->media->update($media, $request->all());

        return redirect()->route('admin.video.media.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('video::media.title.media')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Media $media
     * @return Response
     */
    public function destroy(Media $media)
    {
        $this->media->destroy($media);

        return redirect()->route('admin.video.media.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('video::media.title.media')]));
    }
}
