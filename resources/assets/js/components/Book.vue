<template>
    <tr>
        <td 
            class="isbn"
            data-toggle="modal"
            data-target="#modal">
            <a @click="setModal">{{isbn}}</a>
        </td>
        <td class="name">{{name}}</td>
        <td class="state">{{state}}</td>
        <td class="delete">
            <button v-if="loginUser.id === userId" @click="del" class="btn btn-warning">
                削除
            </button>
        </td>
    </tr>
</template>

<script>
export default {
    name: 'book',
    props: {
        isbn: {
            type: String,
            required: true
        },
        name: {
            type: String,
            required: true
        },
        //本の状態は非同期にどんどん取得していく
        state: {
            type: String,
            required: false
        },
        id: {
            type: Number,
            required: true
        },
        userId: {
            type: Number,
            required: true
        },
        loginUser: {
            type: Object
        },
        author: {
            type: String
        },
        published: {
            type: String
        },
        description: {
            type: String
        },
        page: {
            type: Number
        },
        thumbnail: {
            type: String
        }
    },
    methods: {
        del: function () {
            axios.post('/books/delete', {
                id: this.id
            }).then(res => {
                this.$emit('showEvent')
            });
        },
        setModal: function () {
            this.$emit('modalEvent',{
                isbn: this.isbn,
                name: this.name,
                state: this.state,
                id: this.id,
                author: this.author,
                published: this.published,
                description: this.description,
                page: this.page,
                thumbnail: this.thumbnail
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