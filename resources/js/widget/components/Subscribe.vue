<template lang="pug">
    a(class="tines-subscribe" @click="open(url, $event)" href="#") {{ message }}
</template>

<script>
    import queryString from 'query-string'
    import open from '../mixins/open';

    export default {
        mixins: [open],
        props: [
            'name', 
            'message'
        ],
        data() {
            return {
                url: 'https://www.tistory.com/oauth/authorize/?' + queryString.stringify({
                    'client_id': '2985876bbf036691bb3bdb98c1626faf',
                    'redirect_uri': 'https://tines.kr/auth/login',
                    'response_type': 'code',
                    'state': JSON.stringify({
                        'name': this.name,
                        'type': 'subscribe'
                    })
                }),
            }
        }
    }
</script>

<style lang="stylus" scoped>
    .tines-subscribe
        background-color white
        border none
        cursor pointer
        color rgba(0, 0, 0, .7)
        font-size 14px
        border 1px solid rgba(0, 0, 0, .1)
        transition-duration .2s
        border-radius 5px
        padding 8px 10px
        width 100%
        display inline-block
        text-align center
        text-decoration none
        line-height 30px
        box-sizing border-box
        &:hover
            background-color #f54
            color white
</style>