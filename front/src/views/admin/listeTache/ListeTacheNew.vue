<template>
    <form @submit.prevent="create" method="POST">
        <div class="formGroup">
            <label for="tache_titre">Titre </label>
            <input type="text" id="tache_titre" v-model="ListeTache.titre" required />
        </div>
        <div class="formGroup">
            <label for="tache_description">Description </label>
            <input type="text" id="tache_description" v-model="ListeTache.description" required />
        </div>
        <div class="formGroup">
            <label for="tache_user">Affecté à un utilisateur</label>
            <select v-model="ListeTache.userId">
                <template  v-for="user in users">
                    <option :key="user.id" v-if="user.roles.includes('ROLE_ADMIN')" :value="user['@id']" >{{ user.username }}</option>
                </template>
            </select>
        </div>
        <div class="formGroup">
            <button type="submit">Crée</button>
        </div>
    </form>
</template>

<script>
import ListeTachesService from "@/services/listeTachesService";
import {displayMsg} from "@/utils/toast";
import router from "@/router";
import userService from "@/services/userService";
export default {
    name: "AdminListeTacheNew",
    data(){
        return{
            ListeTache:{},
            users:{}
        }
    },
    methods:{
        create(){
            ListeTachesService.newListeTache(this.ListeTache)
                .then(displayMsg({msg: "Liste Tache a bien été crée", type:"success"}))
                .catch(err=>console.log(err))
            setTimeout(()=>{
                router.push('/admin/liste-taches')
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
