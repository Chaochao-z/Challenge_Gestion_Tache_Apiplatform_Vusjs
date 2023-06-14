<template>
    <h1> Les Listes Taches</h1>
    <table>
        <thead>
        <tr>
            <th>Titre</th>
            <th>Description</th>
            <th>Date Création</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="tache in listeTaches" :key="tache.id">
            <td>{{ tache.titre }}</td>
            <td>{{ tache.description }}</td>
            <td>{{ moment(tache.CreatedAt).format("DD / MM / YYYY") }}</td>
            <td><Btn :type="'link'" :to="{ name: 'AdminListeTacheEdit', params: { id: tache.id } }">See or edit</Btn></td>
        </tr>
        </tbody>
    </table>

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
