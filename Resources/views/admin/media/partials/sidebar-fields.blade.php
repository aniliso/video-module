<div class="box box-primary">
    <div class="box-body">

        {!! Form::normalSelect('category_id', trans('video::media.form.category_id'), $errors, $categories) !!}

        <div class="form-group{{ $errors->has("sorting") ? ' has-error' : '' }}">
            {!! Form::label("sorting", trans('video::media.form.sorting').':') !!}
            {!! Form::input("text", "sorting", old("sorting", $media->sorting ?? '0'), ['class'=>'form-control']) !!}
            {!! $errors->first("sorting", '<span class="help-block">:message</span>') !!}
        </div>
        <div class="form-group">
            {!! Form::hidden('status', 0) !!}
            {!! Form::checkbox('status', 1, old('status', $media->status ?? false), ['class'=>'flat-blue']) !!}
            {!! Form::label('status', trans('video::media.form.status')) !!}
        </div>
        <div class="form-group">
            {!! Form::checkbox('updateImage', 1, old('updateImage'), ['class'=>'flat-blue']) !!}
            {!! Form::label('updateImage', trans('video::media.form.updateImage')) !!}
        </div>

        @mediaSingle('videoMedia', $media ?? null, null, trans('video::categories.form.image'))
    </div>
</div>

<div class="box box-primary" v-if="video.code">
    <div class="box-body">
        <div class="embed-responsive embed-responsive-16by9" v-html="video.code"></div>
    </div>
</div>
