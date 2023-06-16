<template>
    <div style="width: 100%" class="p-5 adminEditBox">
        <h1 class="text-light text-center mb-3">Liste : {{ user.username }}</h1>
        <form @submit.prevent="edit()" class="bg-light m-auto p-5 rounded" style="width: 800px;">
            <div class="d-flex justify-content-between mt-3 mb-3 align-items-center">
                <label for="tache_titre" style="width: 200px">Username</label>
                <input class="form-control" type="text" id="tache_titre" v-model="user.username" />
            </div>
            <div class="d-flex justify-content-between mt-3 mb-3 align-items-center">
                <label for="tache_description" style="width: 200px">Email </label>
                <input class="form-control" type="text" id="tache_description" v-model="user.mail" />
            </div>
            <div class="formGroup">
                <button class="btn btn-primary" type="submit">Modifier</button>
            </div>
        </form>
        <form @submit.prevent="deleteUser()" class="text-center mt-5">
            <button class="btn btn-outline-danger" type="submit">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24"><path fill="red" d="M7 21q-.825 0-1.413-.588T5 19V6H4V4h5V3h6v1h5v2h-1v13q0 .825-.588 1.413T17 21H7ZM17 6H7v13h10V6ZM9 17h2V8H9v9Zm4 0h2V8h-2v9ZM7 6v13V6Z"/></svg>
                Supprimer
            </button>
        </form>
    </div>
</template>

<script>

import userService from "@/services/userService";
import {displayMsg} from "@/utils/toast";
import router from "@/router";
export default {
    name: 'userindex',
    props: ['id'],
    data(){
        return{
            user:{}
        }
    },
    methods:{
      edit(){
          userService.updateUser(this.user)
              .then(
                  displayMsg({msg: "User a bien été modifier", type:"success"})
              )
              .catch(err => console.log(err))
      },
      deleteUser(){
          if (window.confirm('Êtes-vous sûr de vouloir supprimer cette Utilisateur ?')) {
              userService.deleteUser(this.id)
                  .then(
                      displayMsg({msg: "User a bien été supprimer", type:"success"})
                  )
                  .catch(err => console.log(err))
              setTimeout(()=>{
                  router.push('/admin/users')

              },1500)
          }
      }
    },
    mounted() {
        userService.getSelfUser(this.id)
            .then(res => {
                this.user = res
            })
            .catch(err => console.log(err))
    }
}
</script>

<style>

</style>
