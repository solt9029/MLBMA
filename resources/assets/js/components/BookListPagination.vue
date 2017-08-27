<template>
    <div id="pagination">
        <ul class="pagination">
            <li><router-link :to="{query: {page: 1}}">«</router-link></li>
            <li :class="{active: n === page}" v-for="n in lastPage"><router-link :to="{query: {page: n}}">{{n}}</router-link></li>
            <li><router-link :to="{query: {page: lastPage}}">»</router-link></li>
        </ul>
    </div>
</template>

<script>
export default {
    name: 'book-list-pagination',
    props: {
        page: {
            type: Number
        },
        lastPage: {
            type: Number
        }
    }
}
</script>

<style>
#pagination {
    text-align:center;
}
</style>