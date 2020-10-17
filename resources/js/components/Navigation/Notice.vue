<template lang="pug">
    #notice
        i.fas.fa-volume-down
        a.notice(href="https://pronist.tistory.com" target="_blank") 티스토리 이웃 서비스, 티네스(Tines)를 소개합니다.
</template>

<script>
    export default {
        /** empty */
    }
</script>

<style lang="stylus">
    #nav
        #notice
            display inline-block
            *
                line-height 20px
                color black
                font-weight 400
            .fa-volume-down
                font-weight 400
                font-size 1.2em
                margin-right 10px
                position relative
                top 1px
            a
                transition-duration .2s
                &:hover
                    color #FF5544
</style>
