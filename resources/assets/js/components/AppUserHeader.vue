<template>
    <header class="jumbotron">
        <div class="container">
            <h1>{{paramUser.handle}}</h1>
            <a target="blank" :href="`http://twitter.com/${paramUser.handle}`">
                http://twitter.com/{{paramUser.handle}}
            </a>
        </div>
    </header>
</template>

<script>
export default {
    name: 'app-user-header',
    props: {
        paramUser: {
            type: Object
        }
    }
}
</script>

<style>
header.jumbotron {
/*    background: url("img/header.png");
    background-position: center center;*/
    background-size: cover;
    /*color: #fff;*/
}
</style>