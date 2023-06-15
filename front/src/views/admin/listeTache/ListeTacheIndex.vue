<template>
    <div class="p-5 adminIndexBox" style="width: 100%">
        <h1 class="text-light"> Les Listes Taches</h1>
        <div class="adminScrollBox">
            <div v-for="tache in listeTaches" :key="listeTaches.id" class="adminBlockShow">
                <h1 class="text-center">{{ tache.titre }}</h1>
                <div class="d-flex justify-content-between align-items-center">
                    <p style="height: 60px;overflow-y: scroll;">{{ tache.description }}</p>
                </div>
                <div class="d-flex justify-content-between">
                    <p>Date de Création : {{ moment(tache.createdAt).format("DD / MM /YYYY") }}</p>
                    <a :href="`/admin/liste-taches/edit/${tache.id}`"><svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24"><path fill="#11caf0" d="m18.988 2.012l3 3L19.701 7.3l-3-3zM8 16h3l7.287-7.287l-3-3L8 13z"/><path fill="#11caf0" d="M19 19H8.158c-.026 0-.053.01-.079.01c-.033 0-.066-.009-.1-.01H5V5h6.847l2-2H5c-1.103 0-2 .896-2 2v14c0 1.104.897 2 2 2h14a2 2 0 0 0 2-2v-8.668l-2 2V19z"/></svg></a>
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
    name: "AdminListeTacheIndex",
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
            })
            .catch(err => console.log(err))
    }
}
</script>

<style scoped>

</style>
