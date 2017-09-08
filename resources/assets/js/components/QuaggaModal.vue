<template>
    <div class="modal fade" id="quaggaModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="modal-label">バーコードからISBNを読み取る</h4>
                </div>
                <div class="modal-body">
                    <div id="scanner-container"></div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Quagga from 'quagga'

export default {
    name: 'quagga-modal',
    methods: {
        init: function () {
            Quagga.init({
                inputStream: {
                    name: "Live",
                    type: "LiveStream",
                    target: document.querySelector('#scanner-container'),
                    constraints: {
                        //画面比率を変えたかったらこの部分にwidthとheightを指定する
                        facingMode: "environment"
                    },
                },
                decoder: {
                    readers: ["ean_reader"],
                    debug: {
                        showCanvas: true,
                        showPatches: true,
                        showFoundPatches: true,
                        showSkeleton: true,
                        showLabels: true,
                        showPatchLabels: true,
                        showRemainingPatchLabels: true,
                        boxFromPatches: {
                            showTransformed: true,
                            showTransformedBox: true,
                            showBB: true
                        }
                    }
                },
            }, function (err) {
                if (err) {
                    console.log(err)
                    return
                }
                Quagga.start()
            })

            // この部分はほぼライブラリだと思ってください。バーコードっぽい部分に四角とか描写したりします。
            Quagga.onProcessed(function (result) {
                var drawingCtx = Quagga.canvas.ctx.overlay
                var drawingCanvas = Quagga.canvas.dom.overlay

                if (result) {
                    if (result.boxes) {
                        drawingCtx.clearRect(0, 0, parseInt(drawingCanvas.getAttribute("width")), parseInt(drawingCanvas.getAttribute("height")))
                        result.boxes.filter(function (box) {
                            return box !== result.box
                        }).forEach(function (box) {
                            Quagga.ImageDebug.drawPath(box, { x: 0, y: 1 }, drawingCtx, { color: "green", lineWidth: 2 })
                        })
                    }

                    if (result.box) {
                        Quagga.ImageDebug.drawPath(result.box, { x: 0, y: 1 }, drawingCtx, { color: "#00F", lineWidth: 2 })
                    }

                    if (result.codeResult && result.codeResult.code) {
                        Quagga.ImageDebug.drawPath(result.line, { x: 'x', y: 'y' }, drawingCtx, { color: 'red', lineWidth: 3 })
                    }
                }
            })

            Quagga.onDetected(function (result) {
                console.log(result.codeResult.code)
                $('#quaggaModal').modal('hide')
            })
        }
    },
    mounted() {
        this.init()
    }
}
</script>

<style>
/* scopedをつけると何故か上手く行かないのでここだけとりあえずこれで！ */
#scanner-container video {
  width: 100%;
  height: 100%;
}

#scanner-container canvas {
  top: 0px;
  left: 0px;
  position: absolute;
}
</style>