<template>
    <div id="pagination">
        <ul class="pagination">
            <li v-if="page > 1"><router-link :to="{path: '/', query: {page: page - 1}}">Prev</router-link></li>
            <li v-if="page < lastPage"><router-link :to="{path: '/', query: {page: page + 1}}">Next</router-link></li>
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
</style>