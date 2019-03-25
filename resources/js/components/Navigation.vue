<template lang="pug">
    nav#nav(role="navigation")
        .menu.left
            a.item.logo(href="/")
            .item: Donation
            .item: Notice
        .menu.right
            .item.profile(v-if="is_logined" style="padding-right: 0;")
                img(v-if="profile_image_url" :src="profile_image_url" alt="프로필 사진")
                img(v-else src="/images/default.png" alt="프로필 사진")
                Menu
            a.item.login(v-else style="padding-right: 0;" href="/auth/login") 티스토리 로그인
</template>

<script>
    import Notice from "./Navigation/Notice.vue";
    import Donation from './Navigation/Donation.vue';
    import Menu from './Navigation/Menu.vue';

    export default {
        props: [
            'profile_image_url',
            'is_logined'
        ],
        components: {
            Notice,
            Donation,
            Menu
        }
    }
</script>

<style lang="stylus">
    $paddingTopBottom = 15px
    $lineHeight = $paddingTopBottom + 33px
    $height = $lineHeight + 20px

    #nav
        margin 0 auto
        position fixed
        z-index 2
        height $height
        line-height $lineHeight
        width 100%
        min-width 1170px
        box-sizing border-box
        padding $paddingTopBottom 60px
        background-color white
        border-bottom 1px solid rgba(0, 0, 0, .06)
        .menu
            line-height $lineHeight - 11px
            &.left
                float left
            &.right
                float right
        .item
            display inline-block
            padding 0 15px
            color rgba(0, 0, 0, .7)
            font-weight 400
            line-height 25px
            transition-duration .2s
            &:hover
                color #FF5544
        .logo
            background url(/images/logo.png)
            width 24px
            height 24px
            background-repeat no-repeat
            position relative
            top 8px
            float left
            padding 0px
            margin-right 35px
        .profile
            position relative
            &:hover
                color #FF5544
            img
                width 38px
                height 38px
                border-radius 50%
</style>