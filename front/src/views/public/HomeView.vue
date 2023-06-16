<script>
import Btn from "@/components/Common/Btn.vue";
import {userAuthStore} from "@/stores/auth";
import {TOKEN_STORAGE_KEY} from "@/constants/storage_keys";
import jwt_decode from "jwt-decode";
import router from "@/router";

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
        },
        mounted() {
            let token = localStorage.getItem(TOKEN_STORAGE_KEY)
            if(token)
            {
                const decodetoken = jwt_decode(token);
                if (decodetoken.roles.includes("ROLE_ADMIN"))
                {
                    router.push('/admin')
                }
                if (decodetoken.roles.includes("ROLE_STANDARD"))
                {
                    router.push('/dashboard')
                }
                if (decodetoken.roles.includes("ROLE_OBSERVATEUR"))
                {
                    router.push('/observateur')
                }

            }
        }
    }
</script>

<template>
    <div class="home">
        <div class="home-center">
            <h1>Bienvenue sur le site Task Story</h1>
            <div class="d-flex justify-content-center" style="gap:10px">
                <a href="/login" class="btn btn-primary">Connexion</a>
                <a href="/register" class="btn btn-primary">Register</a>
            </div>

        </div>
    </div>
</template>

<style>
.home{
    height: 100vh;
    background: linear-gradient(#6e68ee,#20bdce);
    display: flex; /* Utilisez flex pour aligner les éléments */
    justify-content: center; /* Centre horizontalement les éléments */
    align-items: center; /* Centre verticalement les éléments */
}
.home-center{
    background-color: white;
    padding: 30px;
    border-radius: 20px;
}
</style>
