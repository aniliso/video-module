@if(Module::has('Video'))
<div class="box-body">
    <div class="form-group">
        {!! Form::label("videos", trans('video::videos.title.videos')) !!}
        {!! Form::select('videos[]', $videoLists, old("videos", $model->videos), ['class'=>'form-control select2', 'multiple'=>'multiple']) !!}
        {!! $errors->first("video", '<span class="help-block">:message</span>') !!}
    </div>
</div>
@endif
