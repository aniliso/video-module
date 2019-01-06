<div class="box box-primary">
    <div class="box-body">
        <div class="form-group{{ $errors->has("sorting") ? ' has-error' : '' }}">
            {!! Form::label("sorting", trans('video::categories.form.sorting').':') !!}
            {!! Form::input("text", "sorting", old("sorting", $category->sorting ?? '0'), ['class'=>'form-control']) !!}
            {!! $errors->first("sorting", '<span class="help-block">:message</span>') !!}
        </div>
        <div class="form-group">
            {!! Form::hidden('status', 0) !!}
            {!! Form::checkbox('status', 1, old('status', $category->status ?? false), ['class'=>'flat-blue']) !!}
            {!! Form::label('status', trans('video::categories.form.status')) !!}
        </div>

        @mediaSingle('videoCategory', $category ?? null, null, trans('video::categories.form.image'))
    </div>
</div>
