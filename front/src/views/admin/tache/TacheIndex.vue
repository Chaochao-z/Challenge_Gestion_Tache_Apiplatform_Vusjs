<template>
    <div class="p-5 adminIndexBox" style="width: 100%">
        <div class="d-flex justify-content-between ">
            <h1 class="text-light"> Les Tâches</h1>
            <div>
                <a href="/admin/tache/new" class="text-decoration-none text-light btn btn-info">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path fill="white" d="M3 5.75A2.75 2.75 0 0 1 5.75 3h12.5A2.75 2.75 0 0 1 21 5.75v6.272a6.463 6.463 0 0 0-2-.848V5.75a.75.75 0 0 0-.75-.75H5.75a.75.75 0 0 0-.75.75v12.5c0 .414.336.75.75.75h5.424c.17.72.46 1.395.848 2H5.75A2.75 2.75 0 0 1 3 18.25V5.75ZM23 17.5a5.5 5.5 0 1 0-11 0a5.5 5.5 0 0 0 11 0Zm-5 .5l.001 2.503a.5.5 0 1 1-1 0V18h-2.505a.5.5 0 0 1 0-1H17v-2.5a.5.5 0 1 1 1 0V17h2.497a.5.5 0 0 1 0 1H18Z"/></svg>
                    New Task
                </a>
            </div>
        </div>

        <div class="adminScrollBox">
            <div v-for="tache in taches" :key="tache.id" class="adminBlockShow">
                <h1 class="text-center">{{ tache.titre }}</h1>
                <div class="d-flex justify-content-between align-items-center">
                    <p v-if="tache.priotity == 1" class="p-3 bg-danger rounded-pill"> Urgent </p>
                    <p v-if="tache.priotity == 2" class="p-3 bg-warning rounded-pill"> Moins Urgent </p>
                    <p v-if="tache.priotity == 3" class="p-3 bg-success rounded-pill"> Pas Urgent </p>
                    <p>Date échéance : {{ moment(tache.dateEcheance).format("DD / MM /YYYY") }}</p>
                    <a :href="`/admin/tache/edit/${tache.id}`"><svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24"><path fill="#11caf0" d="m18.988 2.012l3 3L19.701 7.3l-3-3zM8 16h3l7.287-7.287l-3-3L8 13z"/><path fill="#11caf0" d="M19 19H8.158c-.026 0-.053.01-.079.01c-.033 0-.066-.009-.1-.01H5V5h6.847l2-2H5c-1.103 0-2 .896-2 2v14c0 1.104.897 2 2 2h14a2 2 0 0 0 2-2v-8.668l-2 2V19z"/></svg></a>
                </div>
                <div>
                    <TacheAuteur :userTaches="tache.userTaches"></TacheAuteur>
                </div>
            </div>
<!--            <div style="">
                <table>
                    <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Description</th>
                        <th>Priorité</th>
                        <th>Date D'échéance</th>
                        <th>Date Création</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="tache in taches" :key="tache.id">
                        <td>{{ tache.titre }}</td>
                        <td>{{ tache.description }}</td>
                        <td>{{ tache.priotity }}</td>
                        <td>{{ moment(tache.dateEcheance).format("DD / MM /YYYY") }}</td>
                        <td>{{ moment(tache.CreatedAt).format("DD / MM / YYYY") }}</td>
                        <td><Btn :type="'link'" :to="{ name: 'AdminTacheEdit', params: { id: tache.id } }">See or edit</Btn></td>
                    </tr>
                    </tbody>
                </table>
            </div>-->

        </div>
    </div>



</template>

<script>
import Btn from "@/components/Common/Btn.vue";
import moment from "moment/moment";
import tacheService from "@/services/tacheService";
import userTacheService from "@/services/userTacheService";
import TacheAuteur from "@/components/Tache/TacheAuteur.vue";

export default {
    name: "AdminTacheIndex",
    components: {Btn,TacheAuteur},
    data(){
        return{
            taches:{},
            moment
        }
    },

    async mounted() {
        tacheService.getAllTache()
            .then(res =>{
                this.taches = res['hydra:member']
                console.log(this.taches)

                this.taches.sort(function compare(a,b){
                    if (a.priotity < b.priotity)
                        return -1;
                    if (a.priotity > b.priotity )
                        return 1;
                    return 0;
                })
            })
            .catch(err => console.log(err))
    }
}
</script>

<style scoped>

</style>
