<template>
    <div class="p-5 adminIndexBox" style="width: 100%">
        <h1 class="text-light"> Les Tâches</h1>


        <div class="adminScrollBox">
            <div v-for="tache in taches" :key="tache.id" class="adminBlockShow">
                <h1 class="text-center">{{ tache.titre }}</h1>
                <p>{{ tache.description }}</p>
                <div class="d-flex justify-content-between align-items-center">
                    <p v-if="tache.priotity == 1" class="p-3 bg-danger rounded-pill"> Urgent </p>
                    <p v-if="tache.priotity == 2" class="p-3 bg-warning rounded-pill"> Moins Urgent </p>
                    <p v-if="tache.priotity == 3" class="p-3 bg-success rounded-pill"> Pas Urgent </p>
                    <p>Date échéance : {{ moment(tache.dateEcheance).format("DD / MM /YYYY") }}</p>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
import TacheAuteur from "@/components/Tache/TacheAuteur.vue";
import {userAuthStore} from "@/stores/auth";
import moment from "moment";
import userTacheService from "@/services/userTacheService";
import userService from "@/services/userService";
import tacheService from "@/services/tacheService";

export default {
    name: "observateurTacheIndex",
    components: {TacheAuteur},
    data(){
        return{
            authUser : userAuthStore(),
            user:{},
            taches:[],
            moment

        }
    },
    async mounted() {
        const res = await userService.getUserByUsername(this.authUser.UserData.username)
        this.me = res['hydra:member'][0]
        /*console.log(this.me['@id'])*/
        const ut = await userTacheService.GetAllByUserId(this.me.id)

        for (const usertache of ut['hydra:member']){
            if (usertache.role === "observateur")
            {
                tacheService.getSingleTacheByUserTache(usertache.tache)
                    .then( res=>{
                        this.taches.push(res)
                    } )
                    .catch(err=>console.log(err))
            }
        }

    }

}
</script>

<style scoped>

</style>
