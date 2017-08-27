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
                <a class="btn btn-default navbar-right nav-link" href="/auth/twitter/logout">ログアウト</a>
                <router-link class="navbar-brand navbar-right" :to="{path: `/${loginUser.id}`}">
                    <img :src="loginUser.avatar" class="img-rounded">
                </router-link>
                <!-- <router-link :to="{query: {page: page + 1}}">Next</router-link> -->
                <form class="navbar-form navbar-right">
                    <input type="text" class="form-control" placeholder="Search">
                </form>
            </div>
        </div>
    </nav>
</template>

<script>
export default {
    name: 'app-navbar',
    props: {
        loginUser: {
            type: Object
        }
    }
}
</script>

<style>
.navbar-brand .img-rounded {
    width: 40px;
    height: 40px;
    margin-top: -10px;
    border-radius: 50%;
    border: solid 1px #ddd;
}
.nav-link {
    margin-top: 8px;
}
</style>