<template lang="pug">
    main#main(role="main")
        component(class="animated fadeIn" :is="component" v-for="(thumbnail, index) in displayed" :key = "index" 
            :thumbnail        = "thumbnail"
            :index            = "index"
            :added_parameters = "added_parameters"
            :token            = "token"
            :email             = "email")
        InfiniteLoading(v-if="request_url" @infinite="infiniteHandler" spinner="waveDots")
            div(slot="no-more")
            div(slot="no-results")
</template>

<script>
    import axios from '../plugins/axios';

    import Thumbnail from '../components/Thumbnail.vue';
    import Post from '../components/Post.vue';

    import InfiniteLoading from 'vue-infinite-loading';

    export default {
        props: [
            'thumbnails',
            'request_url',
            'start',
            'count',
            'email',
            'component',
            'token',
            'added_parameters'
        ],
        components: {
            Thumbnail,
            Post,
            InfiniteLoading
        },
        data() {
            return {
                displayed: this.thumbnails,
                requestStart: this.start,
                softDeletes: null
            }
        },
        methods: {
            infiniteHandler($state) {
                let self = this;

                axios.get(self.request_url, {
                    headers: {
                        'Authorization': self.token? 'Bearer '+ self.token: null
                    },
                    params: { 
                        start: self.requestStart,
                        count: self.count,
                        email: self.added_parameters.is_index? null: self.email
                    }
                }).then(({ data }) => {
                    if(data.length) {
                        self.displayed = self.displayed.concat(data);
                        self.requestStart = parseInt(self.requestStart) + parseInt(self.count);
                        $state.loaded();
                    }
                    else {
                        $state.complete();
                    }
                });
            }
        }
    }
</script>

<style lang="stylus">
    #main
        overflow hidden
        margin 0 auto
        padding 35px 0
        width 960px
        .infinite-loading-container
            .loading-wave-dots
                margin-top 25px
        .box
            .links
                margin-top 30px;
                a, button
                    border none
                    background-color white
                    cursor pointer
                    margin 0 5px
                    padding 6px 10px
                    border: 1px solid rgba(0, 0, 0, .3)
                    border-radius 25px
                    font-size .85em
                    font-weight 500
                    color rgba(0, 0, 0, .5)
                    box-sizing border-box
                    transition-duration .2s
                    &:hover
                        background-color #FF5544
                        color white
                        border: 1px solid #FF5544
</style>