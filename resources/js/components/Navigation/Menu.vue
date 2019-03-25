<template lang="pug">
    .dropdownContain
        .dropOut
            .triangle
            ul
                li
                    a(href="/subscribers") 내 구독자
                    i.fas.fa-heart
                li
                    a(href="/neighbors") 내 이웃
                    i.fas.fa-project-diagram
                li
                    a(href="/posts") 새 글 보기
                    i.fas.fa-tasks
                li.border
                    a(href="/manage") 내 블로그 관리
                    i.fas.fa-cog
                li
                    a(href="/auth/logout") 로그아웃
                    i.fas.fa-unlock
                    
</template>

<script>
    export default {
        /** empty */
    }
</script>

<style lang="stylus">
    #nav
        .dropdownContain
            width 155px
            position absolute
            z-index 2
            left -15px
            top 65px
            margin-left -80px
            .dropOut
                background white
                float left
                position relative
                margin-top 0px
                -webkit-border-radius 4px
                -moz-border-radius 4px
                border-radius 4px
                -webkit-box-shadow 0 1px 6px rgba(0,0,0,.15)
                -moz-box-shadow 0 1px 6px rgba(0,0,0,.15)
                box-shadow 0 1px 6px rgba(0,0,0,.15)
                -webkit-transition all .1s ease-out
                -moz-transition all .1s ease-out
                -ms-transition all .1s ease-out
                -o-transition all .1s ease-out
                transition all .1s ease-out
                .triangle
                    width 0
                    height 0
                    position absolute
                    border-left 8px solid transparent
                    border-right 8px solid transparent
                    border-bottom 8px solid white
                    top -8px
                    right 18px
                    margin-left -8px
                ul
                    float left
                    padding 0
                    margin 0
                    li
                        list-style none
                        text-align left
                        float left
                        width 100%
                        height 40px
                        box-sizing border-box
                        padding 8px 20px
                        color #777
                        -webkit-border-radius 4px
                        -moz-border-radius 4px
                        -webkit-transition background .1s ease-out
                        -moz-transition background .1s ease-out
                        -ms-transition background .1s ease-out
                        -o-transition background .1s ease-out
                        transition background .1s ease-out
                        font-size .95em
                        font-weight 400
                        &:hover
                            background #f6f6f6
                        &.border
                            border-top 1px solid rgba(0, 0, 0, .06)
                        a 
                            float left
                            color rgba(0, 0, 0, .7)
                            -webkit-transition all .1s ease-out
                            -moz-transition all .1s ease-out
                            -ms-transition all .1s ease-out
                            -o-transition all .1s ease-out
                            transition all .1s ease-out
                        i
                            float right
                            width 15px
                            height 15px
                            position relative
                            top 5px
                            color rgba(0, 0, 0, .3)
</style>