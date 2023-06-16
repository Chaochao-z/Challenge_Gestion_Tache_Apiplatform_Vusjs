<template>
    <div class="p-5 adminIndexBox" style="width: 100%">
        <div class="d-flex justify-content-between">
            <h1 class="text-light"> Les Listes Taches</h1>

        </div>

        <div class="adminScrollBox">
            <div v-for="tache in listeTaches" :key="listeTaches.id" class="adminBlockShow">
                <h1 class="text-center">{{ tache.titre }}</h1>
                <div class="d-flex justify-content-between align-items-center">
                    <p style="height: 60px;overflow-y: scroll;">{{ tache.description }}</p>
                </div>
                <div class="d-flex justify-content-between">
                    <p>Date de Création : {{ moment(tache.createdAt).format("DD / MM /YYYY") }}</p>

                </div>
            </div>
        </div>
    </div>


    <!--        <tr v-for="tache in listeTaches" :key="tache.id">
                <td>{{ tache.titre }}</td>
                <td>{{ tache.description }}</td>
                <td>{{ moment(tache.CreatedAt).format("DD / MM / YYYY") }}</td>
                <td><Btn :type="'link'" :to="{ name: 'AdminListeTacheEdit', params: { id: tache.id } }">See or edit</Btn></td>
            </tr>-->


</template>

<script>
import Btn from "@/components/Common/Btn.vue";
import moment from "moment/moment";
import listeTachesService from "@/services/listeTachesService";

export default {
    name: "ObservateurListeTacheIndex",
    components: {Btn},
    data(){
        return{
            listeTaches:[],
            moment
        }
    },
    mounted() {
        listeTachesService.getAllListeTache()
            .then(res =>{
                this.listeTaches = res['hydra:member']
                this.listeTaches.sort(function compare(a,b){
                    if (a.titre < b.titre)
                        return -1;
                    if (a.titre > b.titre )
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
