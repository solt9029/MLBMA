<template>
    <div>
        <app-navbar></app-navbar>
        This is a login page!!
        <a href="/auth/twitter" role="button">Login with Twitter</a>
    </div>
</template>

<script>
import AppNavbar from './AppNavbar'
export default {
    name: 'login-page',
    components: {
        AppNavbar
    }
}
</script>

<style scoped>
</style>