<template>
    <div style="width: 100%" class="p-5 adminEditBox">
        <h1 class="text-light text-center mb-3">Tache : {{ tache.titre }}</h1>
        <form @submit.prevent="DashboardTacheEdit()" class="bg-light m-auto p-5 rounded" style="width: 800px;">
            <h2>Update Form Task</h2>
            <div class="d-flex justify-content-between mt-3 mb-3 align-items-center">
                <label for="tache_titre" style="width: 200px">Titre :</label>
                <input class="form-control" type="text" id="tache_titre" v-model="tache.titre" required/>
            </div>

            <div class="d-flex justify-content-between mt-3 mb-3">
                <label for="tache_description" style="width: 200px">Description :</label>
                <textarea class="form-control" rows="6" id="tache_description" v-model="tache.description" required> </textarea>
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
                <label for="tache_observateur" style="width: 200px">Observateur : </label>
                <select class="form-control" id="tache_observateur" v-model="tache_user_observateur.userId">
                    <option v-for="user in users" :key="user.id" :value="user['@id']">{{ user.username }}</option>
                </select>
            </div>
            <div class="d-flex justify-content-between mt-3 mb-3 align-items-center">
                <label for="tache_liste" style="width: 200px">Liste : </label>
                <select class="form-control" id="tache_liste" v-model="tache.listeTache">
                    <option v-for="liste in liste_tache" :key="liste.id" :value="liste['@id']">{{ liste.titre }}</option>
                </select>
            </div>
            <div class="formGroup">
                <button class="btn btn-primary" type="submit">Modifier</button>
            </div>
        </form>
        <form @submit.prevent="deleteTache" class="text-center mt-3" >
            <button class="btn btn-outline-danger" type="submit">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24"><path fill="red" d="M7 21q-.825 0-1.413-.588T5 19V6H4V4h5V3h6v1h5v2h-1v13q0 .825-.588 1.413T17 21H7ZM17 6H7v13h10V6ZM9 17h2V8H9v9Zm4 0h2V8h-2v9ZM7 6v13V6Z"/></svg>                Supprimer
            </button>
        </form>
    </div>
</template>

<script>
import tacheService from "@/services/tacheService";
import {displayMsg} from "@/utils/toast";
import userTacheService from "@/services/userTacheService";
import router from "@/router";
import userService from "@/services/userService";
import ListeTachesService from "@/services/listeTachesService";
import {userAuthStore} from "@/stores/auth";

export default {
    name: "DashboardTacheEdit",
    props:['id'],
    data(){
        return{
            tache:{},
            auteur:{},
            tache_user_observateur:{},
            users:{},
            liste_tache:{},
            authUser: userAuthStore(),
            me:{}
        }
    },
    methods:{
        DashboardTacheEdit(){
            this.tache.priotity = parseInt(this.tache.priotity)
            tacheService.updateTache(this.tache)
                .then(displayMsg({msg: "Tache a bien été modifier", type:"success"}))
                .catch(err => {
                        displayMsg({msg:"Titre déjà existé",type:"error"})
                        console.log(err)}
                    )

            this.auteur.role="auteur"
            this.auteur.tacheid =this.tache.id
            this.auteur.userid = this.me.id


            if (this.tache_user_observateur.id !== undefined)
            {
                userTacheService.updateUserTache(this.tache_user_observateur)
                    .then()
                    .catch(err => console.log(err))
            }
            else {
                this.tache_user_observateur.role="observateur"
                this.tache_user_observateur.tacheid= this.tache.id
                this.tache_user_observateur.userid=parseInt(this.tache_user_observateur.userId.split('/')[2])
                userTacheService.newUserTache(this.tache_user_observateur)
            }

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
            if (window.confirm('Êtes-vous sûr de vouloir supprimer cette tâche ?')) {
                tacheService.deleteTache(this.tache.id)
                    .then(
                        displayMsg({msg: "Tache a bien été supprimer", type:"success"})
                    )
                    .catch(err => console.log(err))
                setTimeout(()=>{
                    router.push('/dashboard/taches')

                },1500)
            }


        },


    },
    async mounted() {
        const user = await userService.getUserByUsername(this.authUser.UserData.username)
        this.me = user

        tacheService.getSingleTache(this.id)
            .then(res=> {
                this.tache = res
                this.tache.dateEcheance = this.formatDate(this.tache.dateEcheance);
                if (this.me['hydra:member'][0].id !== this.tache.propid )
                {
                    router.push('/dashboard/taches')
                }
            })
            .catch(err => console.log(err))
        userService.getAllUsers()
            .then(res=>{
                this.users=res['hydra:member']
            })

        userTacheService.getAllUserTacheObservateurByIdTache(this.id,"observateur")
            .then(res=>{
                if (res['hydra:member'].length >0)
                {
                    this.tache_user_observateur = res['hydra:member'][0]
                }


            })
            .catch(err=>console.log(err))



        ListeTachesService.getAllListeTacheByUserId(user['hydra:member'][0].id)
            .then(res=>{
                this.liste_tache = res['hydra:member']
            })
            .catch(err=>console.log(err))

    }
}
</script>

<style scoped>

</style>
