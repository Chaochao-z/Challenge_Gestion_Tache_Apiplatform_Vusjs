<script>
import Btn from "@/components/Common/Btn.vue";
import {userAuthStore} from "@/stores/auth";
import {TOKEN_STORAGE_KEY} from "@/constants/storage_keys";
import jwt_decode from "jwt-decode";

    export default {
        name:"homeview",
        components:{
            Btn
        },
        data(){
            return{
                authStore: userAuthStore(),
                token: localStorage.getItem(TOKEN_STORAGE_KEY)
            }
        },
        methods:{
            logout(){
                this.authStore.logout()
            }
        }
    }
</script>

<template>
    <main>
        <h1>Welcome to Home</h1>
    </main>
</template>

<style></style>
