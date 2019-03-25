<template lang="pug">
    .box(:data-id="thumbnail.id" v-if="!hidden")
        .content(:style="{ opacity: opacity }")
            .user
                .landscape(alt="프로필 사진"
                    :style=`{ backgroundImage:
                        'url(' + thumbnail.blogger.profileImageUrl + '),' +
                        'url(https://i1.daumcdn.net/thumb/S100x100/?fname=https%3A%2F%2Ft1.daumcdn.net%2Ftistory_admin%2Fblog%2Fadmin%2Fprofile_default_0'
                        + (Math.floor(Math.random()*6)+1)
                        + '.png)'
                    }`
                )
                .meta
                    .tit(:href="thumbnail.blogger.url" target="_blank") {{ thumbnail.blogger.title }}
                    .blogger {{ thumbnail.blogger.nickname }}
            .description {{ thumbnail.title }}
            .links
                a.view(:href="thumbnail.url" @click="view" target="_blank") 글 읽기
                a.softDelete(@click="softDelete") 그만 볼래요
            .date {{ thumbnail.date }}
</template>

<script>
    import nedb from '../plugins/nedb';

    export default {
        async beforeCreate() {
            let self = this;

            nedb.softDeletes.find({}, (err, docs) => {
                docs.forEach(element => {
                    if(self.thumbnail.id == element.id) {
                        self.hidden = true;
                    }
                });
            });
            nedb.views.find({}, (err, docs) => {
                docs.forEach(element => {
                    if(self.thumbnail.id == element.id) {
                        self.opacity = 0.4;
                    }
                });
            });
        },
        props: [
            'index',
            'thumbnail',
            'added_parameters',
            'token'
        ],
        data() {
            return {
                opacity: 1,
                hidden: false
            }
        },
        methods: {
            softDelete(e) {
                let self = this;

                nedb.softDeletes.insert({ id: self.thumbnail.id }, () => {
                    self.hidden = true;
                });
            },
            view(e) {
                let self = this;

                nedb.views.insert({ id: self.thumbnail.id }, () => {
                    self.opacity = 0.4;
                });
            }
        }
    }
</script>

<style lang="stylus" scoped>
    $width = 225px

    .box
        float left
        margin 5px
        background-color white
        border 1px solid rgba(0, 0, 0, .06)
        width $width
        text-align center
        display block
        animation-delay .5s
        .content
            padding 0 20px
            padding-bottom 20px
            .user
                margin-top 15px
                text-align left
                overflow hidden
                .landscape
                    float left
                    border-radius 50%
                    margin-right 10px
                    position relative
                    top 3px
                    width 35px
                    height 35px
                    background-size cover
                .tit
                    white-space nowrap
                    overflow hidden
                    text-overflow ellipsis
                    color rgba(0, 0, 0, .7)
                    margin-bottom 3px
                    display block
                .blogger
                    white-space nowrap
                    overflow hidden
                    text-overflow ellipsis
                    font-size .95em
                    font-weight 300
                    color rgba(0, 0, 0, .4)
            .description
                display block
                margin-top 10px
                font-size .92em
                line-height 1.8em
                color rgba(0, 0, 0, .6)
                text-align left
                height 70px
                overflow hidden
            .date
                margin-top 25px
                color rgba(0, 0, 0, .4)
                font-size .9em
                text-align left
</style>