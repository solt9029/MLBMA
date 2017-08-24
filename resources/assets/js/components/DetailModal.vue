<template>
    <div class="modal fade" id="modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                    <h4 class="modal-title">{{}}</h4>
                </div>
                <div class="modal-body">
                    本文
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
                    <button type="button" class="btn btn-primary">ボタン</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'detail-modal'
}
</script>