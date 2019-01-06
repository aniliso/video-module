<div class="box-body">
    {!! Form::i18nInput('title', trans('video::categories.form.title'), $errors, $lang, null, ['data-slug' => 'source', 'v-model'=>'video.title']) !!}

    {!! Form::i18nInput('slug', trans('video::categories.form.slug'), $errors, $lang, null, ['data-slug' => 'target', 'v-model'=>'video.slug']) !!}

    {!! Form::i18nTextarea('description', trans('video::categories.form.description'), $errors, $lang, null, ['class'=>'form-control textarea', ':value.prop'=>'video.description']) !!}
</div>
