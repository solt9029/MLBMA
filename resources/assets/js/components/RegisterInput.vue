<template>
    <form @submit.prevent="register">
        <input type="number" class="form-control" v-model="isbn">
        <input type="submit" value="register" class="btn btn-primary btn-block">
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
                this.$emit('showEvent')
            }).catch(res => {
                //this.isbn = null
            })
        }
    }
}
</script>

<style>
</style>