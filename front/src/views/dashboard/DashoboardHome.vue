
<style>


</style>

<script>
import {userAuthStore} from "@/stores/auth";

    export default {
        name: "DashoboardHome",
        data(){
            return{
                authUser : userAuthStore()
            }
        }
    }
</script>

<template>
    <h1> DashboardHome
    </h1>
    <p>
        {{authUser.UserData.username}}
    </p>
</template>
