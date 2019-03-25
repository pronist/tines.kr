<template lang="pug">
    #search
        form(action="/search" method="get")
            input(type="text" placeholder="새로운 티네스 이웃을 찾아보세요!" role="search" name="q")
            i.fas.fa-search
            .hr
</template>

<script>
    export default {
        /** empty */
    }
</script>

<style lang="stylus">
    #header
        #search
            display inline-block
            margin-right 5px
            margin-bottom 25px
            i
                color rgba(0, 0, 0, .7)
                font-size 1.4em
            form
                display inline-block
                height 38px
                input
                    height 38px
                    width 930px
                    border none
                    box-sizing border-box
                    font-family 'Noto Sans KR', sans-serif !important
                    font-weight 300
                    padding-bottom 10px
                    font-size 1.3em
                    color rgba(0, 0, 0, .7)
            .hr
                border-bottom 1px solid rgba(0, 0, 0, .1)
</style>
