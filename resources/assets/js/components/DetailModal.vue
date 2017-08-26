<template>
    <div class="modal fade" id="modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                    <h4 class="modal-title">{{name}}</h4>
                </div>
                <div class="modal-body">
                    <ul>
                        <li>ISBN： {{isbn}}</li>
                        <li>状態（中野図書館）： {{state}}</li>
                    </ul>
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
        }
    }
}
</script>