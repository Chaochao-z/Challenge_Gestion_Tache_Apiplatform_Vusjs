<template>
    <p v-if="auteur">Auteur : {{ auteur.username }}</p>
    <p v-else></p>

</template>

<script>
import userTacheService from "@/services/userTacheService";
import userService from "@/services/userService";

export default {
    name: "TacheAuteurDashboard",
    props:['userTaches'],
    data(){
        return{
            auteur:null
        }
    },
    methods:{
        async getTacheAuteur(userTaches){
            let auteur = {}
            for(const userTache of userTaches)
            {
                const res = await userTacheService.getUserTacheSingle(userTache)
                if (res.role === "auteur")
                {

                    const resq = await userService.getSingleUser(res.userId)
                    auteur = resq
                }
            }
            console.log(auteur)
            return auteur
        }
    },
    async mounted() {
        this.auteur = await this.getTacheAuteur(this.userTaches)
    }
}
</script>

<style scoped>

</style>
