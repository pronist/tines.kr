<template lang="pug">
    footer#footer(role="footer")
        div
            div(style="float: left")
                a.logo(href="/")
                .tit 티스토리 아웃 서비스, #[span(style="color: #FF5544") 티네스(Tines)]
                .copyright 
                    | 티네스(Tines)에 대한 저작권은 개발자 
                    a(href="https://github.com/pronist" style="text-decoration: underline;" target="_blank") 정만수
                    | 에게 있습니다.
            div(style="float: right")
                Navigation
</template>

<script>
    import Navigation from './Footer/Navigation.vue';

    export default {
        components: {
            Navigation
        }
    }
</script>

<style lang="stylus">
    $padding = 80px
    $paddingBottom = $padding - 10px
    $PaddingTop = $paddingBottom - 15px
    
    #footer
        border-top 1px solid rgba(0, 0, 0, .06)
        color rgba(0, 0, 0, .7)
        font-size .95em
        clear both
        margin-top 35px
        padding 0 60px
        padding-bottom $paddingBottom
        padding-top $PaddingTop
        background-color white
        min-width 1170px
        box-sizing border-box
        > div
            overflow hidden
            margin 0 auto
            text-align left
        .tit
            margin-bottom 3px
        .logo
            background url(/images/logo.png)
            width 24px
            height 24px
            background-size 24px 24px
            background-repeat no-repeat
            position relative
            top 5px
            display inline-block
            margin-bottom 20px
        .copyright a
            color rgba(0, 0, 0, .7)
</style>