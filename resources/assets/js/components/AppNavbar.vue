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
                <a class="navbar-brand logo" href="/"></a>
                <a class="navbar-brand" href="/">MLBMA</a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" v-if="!loginUser">
                 <a class="btn btn-warning navbar-right nav-link" href="/auth/twitter">ログイン</a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" v-if="loginUser">
                <a class="btn btn-warning navbar-right nav-link" href="/auth/twitter/logout">ログアウト</a>
                <router-link class="navbar-brand navbar-right" :to="{path: `/${loginUser.id}`}">
                    <img :src="loginUser.avatar" class="img-rounded">
                </router-link>
                <form class="navbar-form navbar-right" @submit.prevent="search">
                    <input type="text" class="form-control" placeholder="Search" v-model="keyword">
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
    },
    data() {
        return {
            keyword: this.$route.query.keyword
        }
    },
    watch: {
        '$route' (to, from) {
            this.keyword = this.$route.query.keyword
        }
    },
    methods: {
        search: function () {
            this.$router.push({
                query: {
                    keyword: this.keyword
                }
            })
        }
    }
}
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css?family=Baloo+Bhaijaan');
nav {
    background-color: #fff;
}
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
.navbar-brand {
    font-family: 'Baloo Bhaijaan', cursive;
    font-size: 30px;
}
.logo{
  background: url("/img/logo.png") no-repeat center center;
  background-size: contain;
  height: 50px;
  width: 50px;
}
</style>