<template>
    <div style="width: 100%" class="p-5 adminEditBox">
        <h1 class="text-light text-center mb-3">New Tache</h1>
        <form @submit.prevent="create()" class="bg-light m-auto p-5 rounded" style="width: 800px;">
            <h2>Create Task</h2>
            <div class="d-flex justify-content-between mt-3 mb-3 align-items-center">
                <label for="tache_titre" style="width: 200px">Titre :</label>
                <input class="form-control" type="text" id="tache_titre" v-model="tache.titre" required/>
            </div>

            <div class="d-flex justify-content-between mt-3 mb-3">
                <label for="tache_description" style="width: 200px">Description :</label>
                <textarea class="form-control" rows="8" id="tache_description" v-model="tache.description" required> </textarea>
            </div>
            <div class="d-flex justify-content-between mt-3 mb-3 align-items-center">
                <label for="tache_priotity" style="width: 200px">Priorité </label>
                <select class="form-control"   id="tache_priotity" v-model="tache.priotity" required>
                    <option value=1>Urgent</option>
                    <option value=2>Moins Urgent</option>
                    <option value=3>Non Urgent</option>
                </select>
            </div>
            <div class="d-flex justify-content-between mt-3 mb-3 align-items-center">
                <label for="tache_dateEcheance" style="width: 200px">Date Echéance :</label>
                <input class="form-control"  type="datetime-local" id="tache_dateEcheance" v-model="tache.dateEcheance" required />
            </div>
            <div class="d-flex justify-content-between mt-3 mb-3 align-items-center">
                <label for="tache_status" style="width: 200px">Status : </label>
                <select class="form-control" id="tache_status" v-model="tache.status" required>
                    <option value=0>En Cours</option>
                    <option value=1>Terminée</option>
                </select>
            </div>
            <div class="d-flex justify-content-between mt-3 mb-3 align-items-center">
                <label for="tache_liste" style="width: 200px">Liste : </label>
                <select class="form-control" id="tache_liste" v-model="tache.listeTache">
                    <option v-for="list in liste" :key="list.id" :value="list['@id']">{{ list.titre }}</option>
                </select>
            </div>
            <div class="formGroup">
                <button class="btn btn-primary" type="submit">Créer</button>
            </div>
        </form>
    </div>
</template>

<script>
import {userAuthStore} from "@/stores/auth";
import userService from "@/services/userService";
import userTacheService from "@/services/userTacheService";
import listeTachesService from "@/services/listeTachesService";
import ListeTachesService from "@/services/listeTachesService";
import router from "@/router";
import tacheService from "@/services/tacheService";
import {displayMsg} from "@/utils/toast";

export default {
    name: "dashboardTacheNew",
    data(){
        return{
            authUser : userAuthStore(),
            tache:{},
            liste:{},
            me:{},
            information:{}
        }
    },
    methods:{
        create(){
            if (this.tache.priotity == "1" || this.tache.priotity == "2" || this.tache.priotity == "3" )
            {
                this.tache.priotity = parseInt(this.tache.priotity)
            }
            else {
                throw new Error("Erreur Formulaire")
                router.push('/dashboard/taches')
            }
            this.tache.propid = this.me.id
            tacheService.newTache(this.tache)
                .then(displayMsg({msg: "Tache a bien été crée", type:"success"}))
                .catch(err => {
                    displayMsg({msg:"Titre déjà existé",type:"error"})
                    console.log(err)})

            setTimeout(()=>{
                router.push('/dashboard/taches')

            },1500)
        }
    },
    async mounted() {
        const res = await userService.getUserByUsername(this.authUser.UserData.username)
        this.me = res['hydra:member'][0]

        ListeTachesService.getAllListeTacheByUserId(this.me.id)
            .then(res=>{
                this.liste = res['hydra:member']
            })
            .catch(err=>console.log(err))


    }
}
</script>

<style scoped>

</style>
