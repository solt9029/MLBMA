<template>
    <form @submit.prevent="register">
        <input type="number" class="form-control" v-model="isbn" placeholder="ISBN（13桁）">
        <input type="submit" value="書籍を登録する" class="btn btn-primary btn-block top-space-button">
    </form>
</template>

<script>
export default {
    name: 'register-input',
    data() {
        return {
           isbn: null
        }
    },
    methods: {
        register: function () {
            //isbnの値のバリデーションをしたい

            axios.post('/books/register', {
                isbn: this.isbn
            }).then(res => {
                this.isbn = null
                console.log(res)
                this.$emit('showEvent')
            }).catch(res => {
                //this.isbn = null
            })
        }
    }
}
</script>

<style scoped>
.top-space-button {
    margin-top:10px;
}
</style>