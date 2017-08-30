<template>
    <div>
        <div v-if="validationError" class="alert alert-danger" role="alert">ISBNは13桁の数字で入力してください</div>
        <div v-if="serverError" class="alert alert-danger" role="alert">登録に失敗しました</div>
        <form @submit.prevent="register" class="input-group">
            <input type="number" v-model="isbn" placeholder="ISBN(13桁)" class="form-control">
            <span class="input-group-btn">
                <input type="submit" value="登録" class="btn btn-primary">
            </span>
        </form>
    </div>
</template>

<script>
export default {
    name: 'register-input',
    data() {
        return {
           isbn: null,
           validationError: false,
           serverError: false
        }
    },
    methods: {
        register: function () {
            //isbnの値のバリデーションをしたい
            if (String(this.isbn).length !== 13) {
                this.validationError = true
                return
            }
            this.validationError = false
            this.serverError = false

            axios.post('/books/register', {
                isbn: this.isbn
            }).then(res => {
                this.isbn = null
                console.log(res)
                this.$emit('showEvent')
            }).catch(res => {
                this.serverError = true
            })
        }
    }
}
</script>

<style scoped>
</style>