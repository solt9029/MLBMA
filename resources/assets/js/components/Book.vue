<template>
    <tr>
        <td class="user-handle" v-if="!this.$route.params.id">
            <router-link :to="{path: `/${book.user_id}`}">{{book.handle}}</router-link>
        </td>
        <td class="isbn">
            <a @click="setModal" data-toggle="modal" data-target="#modal">{{book.isbn}}</a>
        </td>
        <td class="name">{{book.name}}</td>
        <td class="state">{{book.state}}</td>
    </tr>
</template>

<script>
export default {
    name: 'book',
    props: {
        book: {
            type: Object
        },
        loginUser: {
            type: Object
        }
    },
    data() {
        return {
            userHandle: null
        }
    },
    methods: {
        setModal: function () {
            this.$emit('modalEvent',this.book)
        }
    }
}
</script>

<style scoped>
a {
    cursor: pointer;
}
</style>