<template>
    <h1>Liste Tache Id {{ id }}</h1>
    <form @submit.prevent="AdminListeTacheEdit()">
        <div class="formGroup">
            <label for="tache_titre">Titre </label>
            <input type="text" id="tache_titre" v-model="ListeTache.titre" />
        </div>
        <div class="formGroup">
            <label for="tache_description">Description </label>
            <input type="text" id="tache_description" v-model="ListeTache.description" />
        </div>
        <div class="formGroup">
            <button type="submit">Modifier</button>
        </div>
    </form>
    <form @submit.prevent="deleteListeTache">
        <button type="submit">Supprimer</button>
    </form>
</template>

<script>

import {displayMsg} from "@/utils/toast";
import router from "@/router";
import ListeTachesService from "@/services/listeTachesService";
export default {
    name: "AdminListeTacheEdit",
    props:['id'],
    data(){
        return{
            ListeTache:{}
        }
    },
    methods:{
        AdminListeTacheEdit(){
            ListeTachesService.updateListeTache(this.ListeTache)
                .then(displayMsg({msg: "Liste Tache a bien été modifier", type:"success"}))
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
        deleteListeTache(){
            if (window.confirm('Êtes-vous sûr de vouloir supprimer cette tâche ?')) {
                ListeTachesService.deleteListeTache(this.ListeTache.id)
                    .then(
                        displayMsg({msg: "Liste Tache a bien été supprimer", type:"success"})
                    )
                    .catch(err => console.log(err))
                setTimeout(()=>{
                    router.push('/admin/taches')

                },1500)
            }


        }
    },
    mounted() {
        ListeTachesService.getSingleListeTache(this.id)
            .then(res=> {
                this.ListeTache = res
            })
            .catch(err => console.log(err))
    }
}
</script>

<style scoped>

</style>
