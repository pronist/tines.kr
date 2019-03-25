<template lang="pug">
    nav.menu(role="navigation")
        .box(style="margin-left: 0px")
            .tit 소개
            .items
                a.item(href="https://appwriter.tistory.com/133" target="_blank") 티네스가 뭔가요?
        .box
            .tit 가이드북
            .items
                a.item(href="https://appwriter.tistory.com/149" target="_blank") 이웃커넥터 설정하기
                a.item(href="https://docs.tines.kr/" target="_blank") API 가이드북
        .box
            .tit 개발자
            .items
                a.item(href="https://github.com/pronist" target="_blank") 깃허브
                a.item(href="https://brunch.co.kr/@pronist#info" target="_blank") 브런치
                a.item(href="https://appwriter.tistory.com" target="_blank") 티스토리 블로그
        .box(style="margin-right: 0px")
            .tit 티스토리 프로젝트
            .items
                a.item(href="https://tidory.com" target="_blank") 스킨 프레임워크, 티도리(Tidory)
                a.item(href="https://tines.kr" target="_blank") 이웃서비스, 티네스(Tines)
</template>

<script>
    export default {
        /** empty */
    }
</script>

<style lang="stylus">
    #footer
        .menu
            overflow hidden
            .box
                float left
                color rgba(0, 0, 0, .9)
                margin 0 25px
                .tit
                    font-size 1.1em
                    margin-bottom 15px
                .items
                    .item
                        color rgba(0, 0, 0, .7)
                        display block
                        margin-bottom 10px
                        transition-duration .2s
                        font-size 1.05em
                        &:hover
                            color #FF5544
</style>
