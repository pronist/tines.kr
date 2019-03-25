<template lang="pug">
    #recommends
        .tit 티스토리 이웃 서비스, #[span(style="color: #FF5544") 티네스(Tines)]
        .subtit 티스토리 블로거의, 티스토리 블로거에 의한, 티스토리 블로거를 위한
        //- Adsense(
        //-     data-ad-client="ca-pub-2513331130923231"
        //-     data-ad-slot="8232242882"
        //- )
        .bloggers
            .box(v-for="(thumbnail, index) in recommends")
                .landscape(alt="프로필 사진"
                    :style=`{ backgroundImage:
                        'url(' + thumbnail.profileImageUrl + '),' +
                        'url(https://i1.daumcdn.net/thumb/S100x100/?fname=https%3A%2F%2Ft1.daumcdn.net%2Ftistory_admin%2Fblog%2Fadmin%2Fprofile_default_0'
                        + (Math.floor(Math.random()*6)+1)
                        + '.png)'
                    }`
                )
                .content
                    .user
                        a.tit(:href="thumbnail.url" target="_blank") {{ thumbnail.title }}
                        .blogger {{ thumbnail.nickname }}
                    .description 
                        span(v-if="thumbnail.description") {{ cutByte(thumbnail.description, 55) }}
</template>

<script>
    import cutByte from '../../plugins/cutByte';

    export default {
        props: ['recommends'],
        mixins: [
            cutByte
        ]
    }
</script>

<style lang="stylus">
    #header
        #recommends
            margin-top 25px
            display inline-block
            .tit
                font-size 1.5em
                font-weight 400
                color rgba(0, 0, 0, .7)
                margin-bottom 3px
            .subtit
                color rgba(0, 0, 0, .4)
                margin-bottom 25px
            .bloggers
                margin-top 45px
                overflow hidden
                .box
                    width 172px
                    margin 0 10px
                    float left
                    .landscape
                        overflow hidden
                        height 100px
                        width 100px
                        border-radius 50%
                        margin 0 auto
                        background-size cover
                        position relative
                    .content
                        .user
                            margin 20px 0
                            .tit
                                white-space nowrap
                                overflow hidden
                                text-overflow ellipsis
                                color rgba(0, 0, 0, .7)
                                margin-bottom 3px
                                font-size 1.2em
                                display block
                            .blogger
                                white-space nowrap
                                overflow hidden
                                text-overflow ellipsis
                                font-size .95em
                                font-weight 300
                                color rgba(0, 0, 0, .5)
                        .description
                            font-size .92em
                            line-height 1.8em
                            min-height 70px
                            color rgba(0, 0, 0, .4)
</style>
