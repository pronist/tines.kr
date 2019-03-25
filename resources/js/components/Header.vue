<template lang="pug">
    header#header(role="header")
        .content
            Search
            Recommend(:recommends = "recommends")
</template>

<script>
    import Search from './Header/Search.vue';
    import Recommend from './Header/Recommend.vue';

    export default {
        props: ['recommends'],
        components: {
            Search,
            Recommend
        }
    }
</script>

<style lang="stylus">
    $paddingTop = 65px + 68px

    #header
        width 100%
        padding 65px 0
        padding-top $paddingTop
        background-color white
        > .content
            width 960px
            margin 0 auto
            text-align center
            > *
                width 960px
</style>
