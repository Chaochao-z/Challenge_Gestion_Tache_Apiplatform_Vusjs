
<style>
.dashboardHome{
    height: 100vh;
    background: linear-gradient(#6e68ee,#20bdce);
    display: flex; /* Utilisez flex pour aligner les éléments */
    justify-content: center; /* Centre horizontalement les éléments */
    align-items: center; /* Centre verticalement les éléments */
}
.dashboardHome-center{
    background-color: white;
    padding: 30px;
    border-radius: 20px;
}

</style>

<script>
import {userAuthStore} from "@/stores/auth";

export default {
    name: "ObservateurdHome",
    data(){
        return{
            authUser : userAuthStore()
        }
    }
}
</script>

<template>
    <div class="dashboardHome" style="width: 100%">
        <div class="dashboardHome-center">
            <h1>Bienvenue Dans l'interface Observateur</h1>
        </div>
    </div>
</template>
