@extends('layouts.master')

@section('content')
    @component('partials.components.title', [
    'breadcrumb' => 'media.index'
    ])
        <h1>{{ trans('themes::media.meta.title') }}</h1>
    @endcomponent
<div class="container">
    @foreach($medias->chunk(3) as $chunk)
    <div class="row">
        @foreach($chunk as $media)
        <div class="col-md-4 wow bounceInLeft" data-wow-delay=".{{ $loop->iteration }}s">
            <div class="link_on-youtube" style="margin-bottom: 0;">
                <a class="inline" href="#data{{ $media->id }}"><span class="btn bg-color_second"><i class="icon icon-camcorder"></i></span></a>
                <div style="display:none; padding: 0;"><div class="embed-responsive" id="data{{ $media->id }}" style="padding: 0;">{!! $media->embed['code'] !!}</div></div>
                <img src="{{ $media->present()->embedImage(600,325,'fit',80) }}" alt="{{ $media->title }}" />
            </div>
            <h3 class="ui-title-block ui-title-block_small" style="font-size:14px;"><a href="{{ $media->url }}">{{ $media->title }}</a></h3>
        </div>
        @endforeach
    </div>
    @endforeach
    {!! $medias->links() !!}
</div>
@endsection

@push('js-inline')
    <link rel="stylesheet" href="{!! Module::asset('video:js/fancybox/jquery.fancybox.min.css') !!}">
    <script src="{!! Module::asset('video:js/fancybox/jquery.fancybox.min.js') !!}"></script>
    <script>
        $("a.inline").fancybox({
            width: 600,
            height: 350
        });
    </script>
@endpush
