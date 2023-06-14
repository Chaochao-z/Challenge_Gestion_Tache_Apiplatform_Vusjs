<template>
    <form @submit.prevent="create" method="POST">
        <div class="formGroup">
            <label for="tache_titre">Titre </label>
            <input type="text" id="tache_titre" v-model="tache.titre" required />
        </div>
        <div class="formGroup">
            <label for="tache_description">Description </label>
            <input type="text" id="tache_description" v-model="tache.description" required />
        </div>
        <div class="formGroup">
            <label for="tache_priotity">Priorité </label>
<!--
            <input type="text" id="tache_priotity" v-model="tache.priotity" />
-->
            <select id="tache_priotity" v-model="tache.priotity" required>
                <option value=1>Urgent</option>
                <option value=2>Moins Urgent</option>
                <option value=3>Non Urgent</option>
            </select>
        </div>
        <div class="formGroup">
            <label for="tache_dateEcheance">Date Echéance </label>
            <input type="datetime-local" id="tache_dateEcheance" v-model="tache.dateEcheance" required />
        </div>
        <div class="formGroup">
            <button type="submit">Crée</button>
        </div>
    </form>
</template>

<script>
import tacheService from "@/services/tacheService";
import {displayMsg} from "@/utils/toast";
import router from "@/router";
export default {
    name: "AdminTacheNew",
    data(){
        return{
            tache:{}
        }
    },
    methods:{
        create(){
            console.log(this.tache)
            if (this.tache.priotity == "1" || this.tache.priotity == "2" || this.tache.priotity == "3" )
            {
                this.tache.priotity = parseInt(this.tache.priotity)
            }
            else {
                throw new Error("Erreur Formulaire")
                router.push('/admin/taches')
            }
            tacheService.newTache(this.tache)
                .then(displayMsg({msg: "Tache a bien été crée", type:"success"}))
                .catch(err=>console.log(err))
            setTimeout(()=>{
                router.push('/admin/taches')

            },1500)
        }
    }
}
</script>

<style scoped>

</style>
