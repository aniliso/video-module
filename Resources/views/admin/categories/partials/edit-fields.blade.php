<div class="box-body">
    {!! Form::i18nInput('title', trans('video::categories.form.title'), $errors, $lang, $category, ['data-slug' => 'source']) !!}

    {!! Form::i18nInput('slug', trans('video::categories.form.slug'), $errors, $lang, $category, ['data-slug' => 'target']) !!}

    {!! Form::i18nTextarea('description', trans('video::categories.form.description'), $errors, $lang, $category, ['class'=>'form-control textarea']) !!}
</div>
