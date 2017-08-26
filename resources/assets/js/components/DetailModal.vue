<template>
    <div class="modal fade" id="modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                    <h4 class="modal-title">{{name}}</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <img :src="thumbnail" class="thumbnail">
                        </div>
                        <div class="col-sm-8">
                            <ul>
                                <li>ISBN： {{isbn}}</li>
                                <li>状態（中野図書館）： {{state}}</li>
                                <li>著者： {{author}}</li>
                                <li>出版日： {{published}}</li>
                                <li>概要： {{description}}</li>
                                <li>ページ数： {{page}}</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Amazonで探す</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'detail-modal',
    props: {
        isbn: {
            type: String
        },
        name: {
            type: String
        },
        state: {
            type: String
        },
        id: {
            type: Number
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