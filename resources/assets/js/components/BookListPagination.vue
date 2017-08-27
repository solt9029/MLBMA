<template>
    <div id="pagination">
        <ul class="pagination">
            <li><router-link :to="{query: {page: 1, keyword: this.$route.query.keyword}}">«</router-link></li>
            <li :class="{active: n === page}" v-for="n in lastPage"><router-link :to="{query: {page: n, keyword: keyword}}">{{n}}</router-link></li>
            <li><router-link :to="{query: {page: lastPage, keyword: this.$route.query.keyword}}">»</router-link></li>
        </ul>
    </div>
</template>

<script>
export default {
    name: 'book-list-pagination',
    props: {
        lastPage: {
            type: Number
        }
    },
    //v-forの中でthisが使えないっぽいから仕方なくcomputedで生成している
    computed: {
        keyword: function () {
            return this.$route.query.keyword
        },
        page: function () {
            if (!this.$route.query.page) {
                return 1
            }
            return parseInt(this.$route.query.page)
        }
    }
}
</script>

<style scoped>
#pagination {
    text-align:center;
}
</style>