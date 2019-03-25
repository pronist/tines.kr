<template lang="pug">
    mixin base(method, isSubscribe = false)
        .conf
            .row
                .field
                    .tit 가로사이즈
                        unless isSubscribe
                            span.description (220px ~ 550px)
                    if isSubscribe
                        input.width(type="text" v-model.lazy.trim="SubscribeWidth" placeholder="가로사이즈")
                    else
                        input.width(type="text" v-model.lazy.trim="width" placeholder="가로사이즈")
                .field
                    .tit 구독버튼 제목
                    input.width(type="text" v-model.lazy.trim="label" placeholder="구독버튼 제목")
                if isSubscribe
                    .field
                        .tit 프레임 높이 #[span.description (48px ~)]
                        input.height(type="text" v-model.lazy.trim="SubscribeHeight" placeholder="높이")
            .row
                .field
                    .tit 미리보기
                    block
            .row
                .field
                    .generate(@click=`${method}`) 코드 생성
                    pre(style="display: none;")
                        code(class="language-html")
    #code
        .tit #[span(style="color: #FF5544") 티네스(Tines)] 이웃커넥터 및 구독버튼
        Tabs(class="tab" :options="{ useUrlFragment: false }")
            Tab(name="이웃커넥터" id="connector")
                +base('generateConnectorCode')
                    iframe(
                        style="min-width: 220px;" 
                        :src=`'/widget/neighbor-connector?&name=' + name + '&message=' + label` 
                        :width="width" 
                        height="420" 
                        frameBorder="0"
                    )
            Tab(name="구독버튼" id="subscribe")
                +base('generateSubscribeCode', true)
                    iframe(
                        style="min-height: 48px;" 
                        :src=`'/widget/subscribe?&name=' + name + '&message=' + label` 
                        :width="SubscribeWidth" 
                        :height="SubscribeHeight" 
                        frameBorder="0"
                    )
</template>

<script>
    import { Tabs, Tab } from 'vue-tabs-component';

    export default {
        props: ['email', 'name', 'redirect_uri'],
        components: {
            Tabs, Tab
        },
        data() {
            return {
                width: 280,
                SubscribeHeight: 48,
                SubscribeWidth: 150,
                label: '구독하기'
            }
        },
        watch: {
            SubscribeHeight(val) {
                if(val < 48) {
                    this.SubscribeHeight = 48;
                }
            },
            SubscribeWidth(val) {
                if(val > 550) {
                    this.SubscribeWidth = 550;
                }
            },
            width(val) {
                if(val < 220) {
                    this.width = 220;
                }
                if(val > 550) {
                    this.width = 550;
                }
            }
        },
        methods: {
            append(e, rawHtml) {
                let $pre = $(e.target).next('pre');
                $pre.css('display', 'block');
                $pre.children('code').text(rawHtml);
                Prism.highlightAll();
            },
            generateConnectorCode(e) {
                let rawHtml = `<!-- 이웃커넥터 -->
<iframe src="${location.origin}/widget/neighbor-connector?name=${this.name}&message=${this.label}" width="${this.width}" height="420" frameBorder="0"></iframe>`;
                this.append(e, rawHtml);
            },
            generateSubscribeCode(e) {
                let rawHtml = `<!-- 구독버튼 -->
<iframe src="${location.origin}/widget/subscribe?name=${this.name}&message=${this.label}" width="${this.SubscribeWidth}" height="${this.SubscribeHeight}" frameBorder="0"></iframe>`;
                this.append(e, rawHtml);
            }
        }
    }
</script>

<style lang="stylus">
    #code
        padding 20px
        .tit
            font-size 1.4em
            color rgba(0, 0, 0, .7)
            margin-bottom 15px
        .conf
            .row
                display block
                margin-bottom 15px
            .field
                margin 0 5px
                display inline-block
                .tit
                    font-size 1em
                    margin-bottom 10px
                    .description
                        color rgba(0, 0, 0, .5)
                        font-size .8em
                input
                    border 1px solid rgba(0, 0, 0, .06)
                    padding 8px 10px
        .generate   
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
        pre
            margin-top 15px
            border-radius 5px
            width 520px
</style>

<style lang="stylus">
    #code
        /** Vue Tabs Component */    
        .tabs-component-tabs
            overflow hidden
            padding 0
            margin 0
            margin-bottom 20px
            .tabs-component-tab
                list-style none
                float left
                text-align center
                padding 0 4px
                &:first-child
                    padding-left 0
                a
                    font-size 14px
                    text-decoration none
                    color rgba(0, 0, 0, .6)
                    transition-duration .2s
                    &:hover
                        color #f54
</style>