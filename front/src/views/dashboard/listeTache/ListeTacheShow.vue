<template>
    <div class="p-5 adminIndexBox" style="width: 100%">
        <h1 class="text-light"> Les Tâches de la liste : {{ liste.titre }}</h1>
        <div class="adminScrollBox">
            <div v-for="tache in taches" :key="tache.id" class="adminBlockShow">
                <h1 class="text-center">{{ tache.titre }}</h1>
                <div class="d-flex justify-content-between align-items-center">
                    <p v-if="tache.priotity == 1" class="p-3 bg-danger rounded-pill"> Urgent </p>
                    <p v-if="tache.priotity == 2" class="p-3 bg-warning rounded-pill"> Moins Urgent </p>
                    <p v-if="tache.priotity == 3" class="p-3 bg-success rounded-pill"> Pas Urgent </p>
                    <p>Date échéance : {{ moment(tache.dateEcheance).format("DD / MM /YYYY") }}</p>
                    <a :href="`/dashboard/tache/edit/${tache.id}`"><svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24"><path fill="#11caf0" d="m18.988 2.012l3 3L19.701 7.3l-3-3zM8 16h3l7.287-7.287l-3-3L8 13z"/><path fill="#11caf0" d="M19 19H8.158c-.026 0-.053.01-.079.01c-.033 0-.066-.009-.1-.01H5V5h6.847l2-2H5c-1.103 0-2 .896-2 2v14c0 1.104.897 2 2 2h14a2 2 0 0 0 2-2v-8.668l-2 2V19z"/></svg></a>
                </div>

            </div>
        </div>
    </div>

</template>

<script>
import TacheAuteur from "@/components/Tache/TacheAuteur.vue";
import moment from "moment/moment";
import ListeTachesService from "@/services/listeTachesService";
import TacheService from "@/services/tacheService";

export default {
    name: "dashboardListeTacheShow",
    components:{TacheAuteur},
    props:['id'],
    data(){
        return{
            taches:{},
            liste:{},
            moment
        }
    },
    async mounted() {
        const res = await ListeTachesService.getSingleListeTache(this.id)
        this.liste = res
        if (res.LesTaches.length != 0){
            TacheService.getTacheByListeId(res.id)
                .then(res=>{

                    this.taches = res['hydra:member']
                    this.taches.sort(function compare(a,b){
                        if (a.titre < b.titre)
                            return -1;
                        if (a.titre > b.titre )
                            return 1;
                        return 0;
                    })

                })
                .catch(err=>console.log(err))
        }

    }

}
</script>

<style scoped>

</style>
