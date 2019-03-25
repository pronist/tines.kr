<template lang="pug">
    .box
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
                span(v-if="thumbnail.description") {{ cutByte(thumbnail.description, 110) }}
        .links
            span.auth(v-if="token")
                span.manage(v-if="added_parameters.is_manage && thumbnail.is_own")
                    span.registered(v-if="thumbnail.id")
                        a.remove(v-if="!thumbnail.default" @click="remove") 등록 해제
                        a.components(@click="show(thumbnail.name, $event)") 커넥터 및 구독버튼
                    span.unregistered(v-else)
                        a.append(@click="append") 블로그 등록
                span.own(v-else)
                    span(v-if="!thumbnail.is_own")
                        span(v-if="thumbnail.is_already")
                            a.unsubscribe(v-if="!added_parameters.is_index" @click="unsubscribe") 구독취소
                        span(v-else)
                            a.subscribe(v-if="added_parameters.is_add" @click="subscribe") 구독하기
                            
</template>

<script>
    import axios from '../plugins/axios';
    import cutByte from '../plugins/cutByte';

    import Code from './Code.vue';
    import Prism from 'prismjs';

    export default {
        mixins: [
            cutByte
        ],
        mounted() {
            toastr.options.positionClass = "toast-bottom-center";
        },
        props: [
            'index',
            'thumbnail',
            'added_parameters',
            'token',
            'email'
        ],
        methods: {
            subscribe(e) {
                axios.post('/neighbors', { name: this.thumbnail.name }, {
                    headers: {
                        'Authorization': 'Bearer '+ this.token
                    }
                }).then(() => {
                    toastr.success('블로그가 구독되었습니다.')
                }).catch(() => {
                    toastr.error('구독에 실패했습니다.')
                });
            },
            unsubscribe(e) {
                let 
                    self = this,
                    $target = $(e.target),
                    $box = $target.parents('.box')
                ;
                axios.delete(`/neighbors/${this.thumbnail.name}`, {
                    headers: {
                        'Authorization': 'Bearer '+ this.token
                    }
                }).then(() => {
                    $box.remove();
                    toastr.warning('구독이 해제되었습니다.');
                });
            },
            remove(e) {
                axios.delete(`${process.env.APP_URL}/blogs/${this.thumbnail.name}`)
                .then(() => {
                    toastr.warning('블로그가 등록 해제되었습니다.');
                });
            },
            append(e) {
                axios.post(`${process.env.APP_URL}/blogs`, { name: this.thumbnail.name })
                .then(() => {
                    toastr.success('블로그가 등록되었습니다.')
                });
            },
            show(name, e) {
                this.$modal.show(Code, {
                    email: this.email,
                    name: name,
                    redirect_uri: this.thumbnail.url
                },{
                    height: 'auto',
                    resizable: true,
                    adaptive: true,
                    scrollable: true
                },{
                    // 'opened': (e) => Prism.highlightAll()
                });
            }
        }
    }
</script>

<style lang="stylus" scoped>
    $width = 310px
    
    .box
        float left
        margin 5px
        padding 25px 50px
        box-sizing border-box
        background-color white
        width $width
        height 363px
        text-align center
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
    #toast-container
        position fixed
        bottom 25px
        > .toast 
            background-image none !important
            .toast-message
                position relative
                left -25px
</style>