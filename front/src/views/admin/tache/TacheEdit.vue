<template>
    <h1>Tache Id {{ id }}</h1>
    <form @submit.prevent="AdminTacheEdit()">
        <div class="formGroup">
            <label for="tache_titre">Titre </label>
            <input type="text" id="tache_titre" v-model="tache.titre" />
        </div>
        <div class="formGroup">
            <label for="tache_description">Description </label>
            <input type="text" id="tache_description" v-model="tache.description" />
        </div>
        <div class="formGroup">
            <label for="tache_priotity">Priorité </label>
            <input type="text" id="tache_priotity" v-model="tache.priotity" />
        </div>
        <div class="formGroup">
            <label for="tache_dateEcheance">Date Echéance </label>
            <input type="datetime-local" id="tache_dateEcheance" v-model="tache.dateEcheance" />
        </div>
        <div class="formGroup">
            <label for="tache_status">Status</label>
            <input type="text" id="tache_status" v-model="tache.status" />
        </div>
        <div class="formGroup">
            <button type="submit">Modifier</button>
        </div>
    </form>
    <form @submit.prevent="deleteTache">
        <button type="submit">Supprimer</button>
    </form>
</template>

<script>

import tacheService from "@/services/tacheService";
import {displayMsg} from "@/utils/toast";
import router from "@/router";
export default {
    name: "AdminTacheEdit",
    props:['id'],
    data(){
        return{
            tache:{}
        }
    },
    methods:{
        AdminTacheEdit(){
            tacheService.updateTache(this.tache)
                .then(displayMsg({msg: "Tache a bien été modifier", type:"success"}))
                .catch(err => console.log(err))
        },
        formatDate(dateString) {
            const date = new Date(dateString);
            const year = date.getFullYear();
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const day = String(date.getDate()).padStart(2, '0');
            const hours = String(date.getHours()).padStart(2, '0');
            const minutes = String(date.getMinutes()).padStart(2, '0');
            return `${year}-${month}-${day} ${hours}:${minutes}`;
        },
        deleteTache(){
            if (window.confirm('Êtes-vous sûr de vouloir supprimer cette Liste de tâche ?')) {
                tacheService.deleteTache(this.tache.id)
                    .then(
                        displayMsg({msg: "Tache a bien été supprimer", type:"success"})
                    )
                    .catch(err => console.log(err))
                setTimeout(()=>{
                    router.push('/admin/taches')

                },1500)
            }


        }
    },
    mounted() {
        tacheService.getSingleTache(this.id)
            .then(res=> {
                this.tache = res
                this.tache.dateEcheance = this.formatDate(this.tache.dateEcheance);
            })
            .catch(err => console.log(err))
    }
}
</script>

<style scoped>

</style>
