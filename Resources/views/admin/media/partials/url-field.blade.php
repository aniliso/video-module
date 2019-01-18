<div class="box-body">
    <div class="input-group input-group-sm" v-bind:class="video.active ? 'has-success' : 'has-error'">
        {!! Form::input('text', 'video_link', old('video', $media->video_link ?? ''), ['class'=>'form-control','v-model'=>'video.video_link']) !!}
        <span class="input-group-btn">
            <button type="button" class="btn btn-success btn-flat" @click="getEmbed()"><i class="fa fa-download"></i> URL'den getir</button>
        </span>
    </div>
</div>

@push('js-stack')
    <script src="{!! Module::asset('video:js/vue/vue.min.js') !!}"></script>
    <script src="{!! Module::asset('video:js/vue/axios.min.js') !!}"></script>
    <script src="{!! Module::asset('video:js/vue/loadingoverlay.min.js') !!}"></script>
    <script>
        Vue.prototype.$http = axios;
        window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
        window.axios.defaults.headers.common['X-CSRF-TOKEN']     = '{{ csrf_token() }}';
        window.axios.defaults.headers.common['Cache-Control'] = 'no-cache';
        new Vue({
            el: '#video-form',
            data: {
                video: {
                    id: '{{ $media->id ?? '' }}',
                    title: '{{ $media->title ?? '' }}',
                    slug: '{{ $media->slug ?? '' }}',
                    description: '{!! isset($media) ? htmlspecialchars($media->description, ENT_QUOTES) : '' !!}',
                    video_link: '{{ $media->video_link ?? '' }}',
                    active: {{ isset($media) ? $media->embed['code'] ? 'true' : 'false' : 'false' }},
                    code: '{!! $media->embed['code'] ?? '' !!}'
                }
            },
            methods: {
                getEmbed() {
                    axios.get('{{ route('api.media.getEmbed') }}?url='+this.video.video_link)
                        .then(response=>{
                            this.video.title       = response.data.data.title;
                            this.video.slug        = response.data.data.slug;
                            this.video.description = response.data.data.description;
                            this.video.code        = response.data.data.code;
                            this.video.active      = true;
                            $('.wysihtml5-sandbox').contents().find('body').html(this.video.description);
                        });
                }
            }
        });
    </script>
@endpush
