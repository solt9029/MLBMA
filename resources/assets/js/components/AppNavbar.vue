<template>
    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">
                <toggle-navigation data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"></toggle-navigation>
                <logo></logo>
                <brand-title></brand-title>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <a class="btn btn-warning navbar-right nav-btn" href="/auth/twitter/logout">ログアウト</a>
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
import ToggleNavigation from './ToggleNavigation'
import Logo from './Logo'
import BrandTitle from './BrandTitle'

export default {
    name: 'app-navbar',
    components: {
        ToggleNavigation,
        Logo,
        BrandTitle
    },
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
.nav-btn {
    margin-top: 8px;
}
</style>