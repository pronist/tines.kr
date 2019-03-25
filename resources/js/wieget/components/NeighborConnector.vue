<template lang="pug">
    //- mixins
    mixin item()
        div(class="item" v-for="thumbnail in thumbnails")
            div(class="thumbnail")
                .landscape(alt="프로필 사진"
                    :style=`{ backgroundImage: 
                        'url(' + thumbnail.profileImageUrl + '),' 
                      + 'url(https://i1.daumcdn.net/thumb/S42x42/?fname=https%3A%2F%2Ft1.daumcdn.net%2Ftistory_admin%2Fblog%2Fadmin%2Fprofile_default_0' + (Math.floor(Math.random()*6)+1) + '.png)' }` 
                )
                div(class="meta")
                    a(class="title" @click="open(thumbnail.url, $event)" href="#") {{ thumbnail.title }}
                    div(class="description") {{ thumbnail.nickname }}
                block
    mixin thumbnails(hasScroll = true)
        div(class="items" class={'userProfile': !hasScroll, 'thumbnails': hasScroll})
            if hasScroll
                div(class="transparent")
                    +item()
            else
                +item()
                    Subscribe(:name="name" :message="message")
            if hasScroll
                InfiniteLoading(@infinite="infiniteHandler")
                    div(slot="no-more")
                    div(slot="no-results")
    //- template
    div(class="tines-connector")
        a(class="title" @click="open('http://tines.kr', $event)" href="#") 
            | #[span(style="color: #f54") 티네스] 이웃 커넥터
        Tabs(class="tab" @changed="tabChanged" :options="{ useUrlFragment: false }")
            Tab(class="neighbors" name="내 이웃" id="neighbors")
                +thumbnails()
            Tab(class="subscribers" name="내 구독자" id="subscribers")
                +thumbnails()
            Tab(class="subscribe" name="구독하기" id="subscribe")
                +thumbnails(false)
</template>

<script>
    import Subscribe from './Subscribe.vue';
    import InfiniteLoading from 'vue-infinite-loading';
    import { Tabs, Tab } from 'vue-tabs-component';

    import axios from '../plugins/axios';
    import open from '../mixins/open';

    export default {
        mixins: [open],
        props: [
            'email',
            'name', 
            'message'
        ],
        data() {
            return {
                start: 0,
                count: 12,
                currentContent: new String(),
                thumbnails: new Array(),
            }
        },
        methods: {
            append: async function(resource, name) {
                /** Request to Tines API */
                let { data } = await axios.get(resource, {
                    params: name? { name: this.name }
                        : {
                            start: this.start,
                            count: this.count,
                            email: this.email
                        }
                });
                if(data.length) {
                    this.thumbnails = this.thumbnails.concat(data);
                    return data;
                }
                else {
                    return false;
                }
            },
            infiniteHandler: async function($state) {
                this.start += this.count;

                let data = await this.append(this.currentContent);
                if(!data.length) {
                    this.start > 0? this.start -= this.count: null;
                    $state.complete();
                }
                else {
                    this.thumbnails = this.thumbnails.concat(data);
                    $state.loaded();
                }
            },
            tabChanged: async function(selectedTab) {
                this.start = 0;
                this.thumbnails = new Array();

                if(selectedTab.tab.id != 'subscribe') {
                    this.currentContent = selectedTab.tab.id;
                    this.append(this.currentContent);
                }
                else {
                    this.append('blogs', this.name);
                }
            }
        },
        components: {
            Tabs, Tab,
            InfiniteLoading,
            Subscribe
        }
    }
</script>

<style lang="stylus" scoped>
    @import "//fonts.googleapis.com/earlyaccess/notosanskr.css"

    .tines-connector
        font-family 'Noto Sans KR', sans-serif
        width 100%
        min-width 220px
        height 420px
        border 1px solid rgba(0,0,0,.06)
        padding 15px
        background-color white
        box-sizing border-box
        > .title
            text-align center
            margin-bottom 15px
            font-size 14px
            color rgba(0, 0, 0, .7)
            display block
            text-decoration none
        .items
            .item
                clear both
                overflow hidden
                .thumbnail
                    overflow hidden
                    .meta
                        > *
                            white-space nowrap
                            overflow hidden
                            text-overflow ellipsis
</style>

<style lang="stylus" scoped>
    .tines-connector
        /** Transparent scroll */
        .items
            box-sizing border-box
            height 320px
            width 100%
            overflow hidden
            .transparent
                overflow-x hidden
                overflow-y scroll
                width 120%
                height 320px
                padding 0 8px
</style>

<style lang="stylus" scoped>
    .tines-connector
         /** Profile */
        .userProfile
            display table
            .item
                width 100%
                height 320px
                display table-cell
                vertical-align middle
                text-align center
                position relative
                top -20px
                .thumbnail
                    margin 0 auto
                    width 188px
                .landscape
                    width 80px
                    height 80px
                    border-radius 50%
                    background-size cover
                    margin 0 auto
                    margin-bottom 25px
                .meta
                    margin 0 auto
                    white-space nowrap
                    .title
                        margin 0 auto
                        margin-bottom 3px
                        color rgba(0, 0, 0, .7)
                        font-size 16px
                        text-decoration none
                        display block
                    .description
                        color rgba(0, 0, 0, .5)
                        font-size 14px
                        margin-bottom 15px
</style>

<style lang="stylus" scoped>
    .tines-connector
        /** Thumbnail */
        .thumbnails
            .item
                font-size 12px
                margin 25px 0
                &:first-child
                    margin-top 0
                .thumbnail
                    white-space nowrap
                    box-sizing border-box
                    .landscape
                        width 42px
                        height 42px
                        border-radius 50%
                        float left
                        margin-right 10px
                        background-size cover
                    .meta
                        float left
                        overflow hidden
                        width 60%
                        .description
                            color rgba(0, 0, 0, .3)
                        .title
                            color rgba(0, 0, 0, .7)
                            margin-bottom 3px
                            font-size 13px
                            text-decoration none
                            display block
</style>

<style lang="stylus" scoped>
    .tines-connector
        /** Vue Tabs Component */
        > /deep/ .tabs-component
            .tabs-component-tabs
                overflow hidden
                padding 0
                margin 0
                margin-bottom 20px
                .tabs-component-tab
                    list-style none
                    float left
                    width 33.33%
                    text-align center
                    .tabs-component-tab-a
                        font-size 14px
                        text-decoration none
                        color rgba(0, 0, 0, .6)
                        transition-duration .2s
                        &:hover
                            color #f54
</style>

<style lang="stylus" scoped>
    .tines-connector
        /** Subscribe */
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
            width 150px
            display inline-block
            text-align center
            text-decoration none
            line-height 30px
            &:hover
                background-color #f54
                color white
</style>