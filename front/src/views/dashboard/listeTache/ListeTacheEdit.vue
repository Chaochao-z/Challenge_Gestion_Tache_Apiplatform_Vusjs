<template>
    <div style="width: 100%" class="p-5 adminEditBox">
        <h1 class="text-light text-center mb-3">Liste : {{ ListeTache.titre }}</h1>
        <form @submit.prevent="AdminListeTacheEdit()" class="bg-light m-auto p-5 rounded" style="width: 800px;">
            <div class="d-flex justify-content-between mt-3 mb-3 align-items-center">
                <label for="tache_titre" style="width: 200px">Titre </label>
                <input class="form-control" type="text" id="tache_titre" v-model="ListeTache.titre" />
            </div>
            <div class="d-flex justify-content-between mt-3 mb-3 align-items-center">
                <label for="tache_description" style="width: 200px">Description </label>
                <input class="form-control" type="text" id="tache_description" v-model="ListeTache.description" />
            </div>
            <div class="formGroup">
                <button class="btn btn-primary" type="submit">Modifier</button>
            </div>
        </form>
        <form @submit.prevent="deleteListeTache" class="text-center mt-5">
            <button class="btn btn-outline-danger" type="submit">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24"><path fill="red" d="M7 21q-.825 0-1.413-.588T5 19V6H4V4h5V3h6v1h5v2h-1v13q0 .825-.588 1.413T17 21H7ZM17 6H7v13h10V6ZM9 17h2V8H9v9Zm4 0h2V8h-2v9ZM7 6v13V6Z"/></svg>
                Supprimer
            </button>
        </form>
    </div>
</template>

<script>
import ListeTachesService from "@/services/listeTachesService";
import {displayMsg} from "@/utils/toast";
import router from "@/router";
import userService from "@/services/userService";
import {userAuthStore} from "@/stores/auth";

export default {
    name: "DashboardListeTacheEdit",
    props:['id'],
    data(){
        return{
            ListeTache:{},
            users:{},
            authUser : userAuthStore(),
            me:{}
        }
    },
    methods:{
        AdminListeTacheEdit(){
            ListeTachesService.updateListeTache(this.ListeTache)
                .then(displayMsg({msg: "Liste Tache a bien été modifier", type:"success"}))
                .catch(err => {
                    displayMsg({msg:"Titre déjà existé",type:"error"})
                    console.log(err)
                }

                )
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
        deleteListeTache(){
            if (window.confirm('Êtes-vous sûr de vouloir supprimer cette Liste tâche ?')) {
                ListeTachesService.deleteListeTache(this.ListeTache.id)
                    .then(
                        displayMsg({msg: "Liste Tache a bien été supprimer", type:"success"})
                    )
                    .catch(err => console.log(err))
                setTimeout(()=>{
                    router.push('/dashboard/listeTache')

                },1500)
            }


        }
    },
    async mounted() {
        const user = await userService.getUserByUsername(this.authUser.UserData.username)
        this.me = user
        ListeTachesService.getSingleListeTache(this.id)
            .then(res=> {

                this.ListeTache = res

                if (this.me['hydra:member'][0]['@id'] !== this.ListeTache.userId )
                {
                    router.push('/dashboard/listeTache')
                }
            })
            .catch(err => console.log(err))

    }
}
</script>

<style scoped>

</style>
