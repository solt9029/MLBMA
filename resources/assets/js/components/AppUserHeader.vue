<template>
    <header class="jumbotron">
        <div class="container">
            <h1 class="handle">{{paramUser.handle}}</h1>
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

<style scoped>
@import url('https://fonts.googleapis.com/css?family=Baloo+Bhaijaan');
header.jumbotron {
/*    background: url("img/header.png");
    background-position: center center;*/
    background-size: cover;
    /*color: #fff;*/
    background:linear-gradient(45deg,rgba(240,240,100,0.9), rgba(180,170,100, 0.9));
    margin-top: -20px;

}
.handle {
    font-family: 'Baloo Bhaijaan', cursive;
    font-size: 100px;
}
</style>