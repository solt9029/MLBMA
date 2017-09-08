<template>
    <div class="modal fade" id="modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                    <h4 class="modal-title">{{modal.name}}</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <img :src="modal.thumbnail" class="thumbnail">
                        </div>
                        <div class="col-sm-8">
                            <ul>
                                <li>ISBN： {{modal.isbn}}</li>
                                <li>状態（中野図書館）： {{modal.state}}</li>
                                <li>著者： {{modal.author}}</li>
                                <li>出版日： {{modal.published}}</li>
                                <li>概要： {{modal.description}}</li>
                                <li>ページ数： {{modal.page}}</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-warning" @click="del" v-if="modal.user_id === loginUser.id">
                        削除
                    </button>
                    <a 
                        target="blank"
                        class="btn btn-primary"
                        :href="`https://www.amazon.co.jp/s/ref=nb_sb_noss?field-keywords=${modal.isbn}`">
                        Amazonで探す
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'detail-modal',
    props: {
        modal: {
            type: Object
        },
        loginUser: {
            type: Object
        }
    },
    methods: {
        del: function () {
            axios.post('/books/delete', {
                id: this.modal.id
            }).then(res => {
                this.$emit('showEvent')
                $('#modal').modal('hide')
            })
        }
    }
}
</script>

<style scoped>
.thumbnail {
    width: 100%;
}
li {
    margin-bottom: 7px;
}
</style>