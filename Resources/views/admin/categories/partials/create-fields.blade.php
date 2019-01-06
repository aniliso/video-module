<div class="box-body">
    {!! Form::i18nInput('title', trans('video::categories.form.title'), $errors, $lang, null, ['data-slug' => 'source']) !!}

    {!! Form::i18nInput('slug', trans('video::categories.form.slug'), $errors, $lang, null, ['data-slug' => 'target']) !!}

    {!! Form::i18nTextarea('description', trans('video::categories.form.description'), $errors, $lang, null, ['class'=>'form-control textarea']) !!}
</div>
