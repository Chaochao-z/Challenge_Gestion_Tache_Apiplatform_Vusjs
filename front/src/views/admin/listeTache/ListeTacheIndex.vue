<template>
    <div class="p-5 adminIndexBox" style="width: 100%">
        <div class="d-flex justify-content-between">
            <h1 class="text-light"> Les Listes Taches</h1>
            <div>
                <a href="/admin/liste-taches/new" class="text-decoration-none text-light btn btn-info">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path fill="white" d="M3 5.75A2.75 2.75 0 0 1 5.75 3h12.5A2.75 2.75 0 0 1 21 5.75v6.272a6.463 6.463 0 0 0-2-.848V5.75a.75.75 0 0 0-.75-.75H5.75a.75.75 0 0 0-.75.75v12.5c0 .414.336.75.75.75h5.424c.17.72.46 1.395.848 2H5.75A2.75 2.75 0 0 1 3 18.25V5.75ZM23 17.5a5.5 5.5 0 1 0-11 0a5.5 5.5 0 0 0 11 0Zm-5 .5l.001 2.503a.5.5 0 1 1-1 0V18h-2.505a.5.5 0 0 1 0-1H17v-2.5a.5.5 0 1 1 1 0V17h2.497a.5.5 0 0 1 0 1H18Z"/></svg>
                    New Liste Tâche
                </a>
            </div>

        </div>

        <div class="adminScrollBox">
            <div v-for="tache in listeTaches" :key="listeTaches.id" class="adminBlockShow">
                <h1 class="text-center">{{ tache.titre }}</h1>
                <div class="d-flex justify-content-between align-items-center">
                    <p style="height: 60px;overflow-y: scroll;">{{ tache.description }}</p>
                </div>
                <div class="d-flex justify-content-between">
                    <p>Date de Création : {{ moment(tache.createdAt).format("DD / MM /YYYY") }}</p>
                    <div>
                        <a :href="`/admin/liste-taches/edit/${tache.id}`"><svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24"><path fill="#11caf0" d="m18.988 2.012l3 3L19.701 7.3l-3-3zM8 16h3l7.287-7.287l-3-3L8 13z"/><path fill="#11caf0" d="M19 19H8.158c-.026 0-.053.01-.079.01c-.033 0-.066-.009-.1-.01H5V5h6.847l2-2H5c-1.103 0-2 .896-2 2v14c0 1.104.897 2 2 2h14a2 2 0 0 0 2-2v-8.668l-2 2V19z"/></svg></a>
                        <a :href="`/admin/liste-taches/tache/${tache.id}`"><svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24"><path fill="#11caf0" d="M12 9a3 3 0 0 0-3 3a3 3 0 0 0 3 3a3 3 0 0 0 3-3a3 3 0 0 0-3-3m0 8a5 5 0 0 1-5-5a5 5 0 0 1 5-5a5 5 0 0 1 5 5a5 5 0 0 1-5 5m0-12.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5Z"/></svg></a>
                    </div>
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
