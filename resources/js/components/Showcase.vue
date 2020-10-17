<template lang="pug">
    #showcase
        .content
            .header
                .tit 블로그에 #[span(style="color: #FF5544") 티네스 이웃커넥터]를 추가해보세요.
                .subtit 이제 더 이상 옆집 이웃커넥터를 사용할 필요가 없습니다!
                a.visit(href="https://pronist.tistory.com" target="_blank") 이웃커넥터 추가하기
            iframe(src=`/widget/neighbor-connector?name=pronist&message=구독하기` width="280" height="420" frameBorder="0")
</template>

<script>
    export default {
        /** empty */
    }
</script>

<style lang="stylus" scoped>
    #showcase
        width 100%
        background-color #FAFAFA
        > .content
            padding 45px 5px
            width 960px
            margin 0 auto
            overflow hidden
            .tines-connector
                float left
            .header
                margin-left 25px
                position relative
                top 45px
                float right
                .tit
                    font-size 2.4em
                    font-weight 400
                    color rgba(0, 0, 0, .7)
                    margin-bottom 3px
                .subtit
                    color rgba(0, 0, 0, .4)
                    margin-bottom 45px
                .visit
                    background-color white
                    border none
                    cursor pointer
                    color rgba(0, 0, 0, .7)
                    font-size 14px
                    border 1px solid rgba(0, 0, 0, .1)
                    transition-duration .2s
                    border-radius 5px
                    padding 8px 10px
                    width 150px
                    display inline-block
                    text-align center
                    text-decoration none
                    line-height 30px
                    &:hover
                        background-color #f54
                        color white
</style>
