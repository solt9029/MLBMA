<template>
    <tr>
        <td>{{isbn}}</td>
        <td>{{name}}</td>
        <td>{{state}}</td>
        <td>
            <button @click="del">
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