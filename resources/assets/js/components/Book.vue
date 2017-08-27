<template>
    <tr>
        <td class="user-handle">
            <a target="blank" :href="`http://twitter.com/${book.handle}`">
                {{book.handle}}
            </a>
        </td>
        <td 
            class="isbn"
            data-toggle="modal"
            data-target="#modal">
            <a @click="setModal">{{book.isbn}}</a>
        </td>
        <td class="name">{{book.name}}</td>
        <td class="state">{{book.state}}</td>
        <td class="delete">
            <button v-if="loginUser.id === book.user_id" @click="del" class="btn btn-warning">
                削除
            </button>
        </td>
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
        del: function () {
            axios.post('/books/delete', {
                id: this.book.id
            }).then(res => {
                this.$emit('showEvent')
            });
        },
        setModal: function () {
            this.$emit('modalEvent',{
                isbn: this.book.isbn,
                name: this.book.name,
                state: this.book.state,
                id: this.book.id,
                author: this.book.author,
                published: this.book.published,
                description: this.book.description,
                page: this.book.page,
                thumbnail: this.book.thumbnail
            })
        }
    }
}
</script>

<style scoped>
a {
    cursor: pointer;
}
</style>