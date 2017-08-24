<template>
    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">MLBMA</a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#">あなたの本</a></li>
                    <li><a href="#">みんなの本</a></li>
                </ul>
                
                <form class="navbar-form navbar-right">
                    <a class="btn btn-default" href="/auth/twitter/logout">ログアウト</a>
                </form>
                <form class="navbar-form navbar-right">
                    <input type="text" class="form-control" placeholder="Search">
                </form>
            </div>
        </div>
    </nav>
</template>

<script>
export default {
    name: 'app-navbar'
}
</script>

<style>
    
</style>