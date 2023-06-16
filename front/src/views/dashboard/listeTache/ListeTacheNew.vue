<template>
    <div style="width: 100%" class="p-5 adminEditBox">
        <h1 class="text-light text-center mb-3">New Liste</h1>
        <form @submit.prevent="create()" class="bg-light m-auto p-5 rounded" style="width: 800px;">
            <h2>Create New List Task</h2>
            <div class="d-flex justify-content-between mt-3 mb-3 align-items-center">
                <label for="tache_titre" style="width: 200px">Titre </label>
                <input class="form-control" type="text" id="tache_titre" v-model="ListeTache.titre" />
            </div>
            <div class="d-flex justify-content-between mt-3 mb-3 align-items-center">
                <label for="tache_description" style="width: 200px">Description </label>
                <input class="form-control" type="text" id="tache_description" v-model="ListeTache.description" />
            </div>
<!--            <div class="d-flex justify-content-between mt-3 mb-3 align-items-center">
                <label for="tache_user" style="width: 200px">Affecté à un utilisateur</label>
                <select class="form-control" v-model="ListeTache.userId">
                    <template  v-for="user in users">
                        <option :key="user.id" v-if="user.roles.includes('ROLE_ADMIN')" :value="user['@id']" >{{ user.username }}</option>
                    </template>
                </select>-->
<!--            </div>-->
            <div class="formGroup">
                <button class="btn btn-primary" type="submit">Créer</button>
            </div>
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
    name: "dashboardListeTacheNew",
    data(){
        return{
            ListeTache:{},
            users:{},
            authUser:userAuthStore()
        }
    },
    methods:{
        async create(){
            const res = await userService.getUserByUsername(this.authUser.UserData.username)
            this.me = res['hydra:member'][0]
            this.ListeTache.userId = "/users/"+this.me.id
            console.log(this.ListeTache)
            console.log(this.me)
            ListeTachesService.newListeTache(this.ListeTache)
                .then(displayMsg({msg: "Liste Tache a bien été crée", type:"success"}))
                .catch(err=>console.log(err))
            setTimeout(()=>{
                router.push('/dashboard/listeTache')
            },1500)
        }
    },
    mounted() {
        userService.getAllUsers()
            .then(res =>{
                this.users = res['hydra:member']
            })
            .catch(err => console.log(err))
    }
}
</script>

<style scoped>

</style>
