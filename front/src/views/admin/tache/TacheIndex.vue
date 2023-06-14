<template>
    <h1> Les Taches</h1>
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

</template>

<script>
import Btn from "@/components/Common/Btn.vue";
import moment from "moment/moment";
import tacheService from "@/services/tacheService";

export default {
    name: "AdminTacheIndex",
    components: {Btn},
    data(){
        return{
            taches:[],
            moment
        }
    },
    mounted() {
        tacheService.getAllTache()
            .then(res =>{
                this.taches = res['hydra:member']
                console.log(res['hydra:member'])
            })
            .catch(err => console.log(err))
    }
}
</script>

<style scoped>

</style>
