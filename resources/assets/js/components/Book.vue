<template>
    <tr>
        <td class="isbn">{{isbn}}</td>
        <td class="name">{{name}}</td>
        <td class="state">{{state}}</td>
        <td class="delete">
            <button @click="del" class="btn btn-warning">
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
        }
    },
    methods: {
        del: function () {
            axios.post('/books/delete', {
                id: this.id
            }).then(res => {
                this.$emit('showEvent')
            });
        }
    }
}
</script>