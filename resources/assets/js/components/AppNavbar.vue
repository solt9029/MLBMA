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
                <!-- yoursかどうかでアクティブになるか決まる -->
                <ul class="nav navbar-nav">
                    <li :class="{ active: yours }">
                        <router-link :to="{path: '/', query: {yours: true, page: 1}}">あなたの本</router-link>
                    </li>
                    <li :class="{ active: !yours }">
                        <router-link :to="{path: '/', query: {yours: false, page: 1}}">みんなの本</router-link>
                    </li>
                </ul>
                
                <form class="navbar-form navbar-right">
                    <a class="btn btn-default" href="/auth/twitter/logout">ログアウト</a>
                </form>
                <a class="navbar-brand navbar-right" :href="twitterUrl" target="blank">
                    <img :src="avatarUrl" class="img-rounded">
                </a>
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
        yours: {
            type: Boolean
        }
    },
    data() {
        return {
            avatarUrl: null,
            twitterUrl: 'http://twitter.com'
        }
    },
    created: function () {
        axios.post('/users/info').then(res => {
            this.avatarUrl = res.data.avatar
            this.twitterUrl = `http://twitter.com/${res.data.handle}`
        })
    }
}
</script>

<style>
.navbar-brand .img-rounded {
    width: 40px;
    height:40px;
    margin-top:-10px;
    margin-right:-15px;
    border-radius:50%;
    border: solid 1px #ddd;
}
</style>