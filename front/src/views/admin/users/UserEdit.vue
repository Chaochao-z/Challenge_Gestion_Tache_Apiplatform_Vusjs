<template>
    <div>
        This is User N° {{ id }}
    </div>
    <form @submit.prevent="edit">
        <div class="formGroup">
            <label for="user_mail">Email</label>
            <input type="text" id="user_mail" v-model="user.mail" />
        </div>
        <div class="formGroup">
            <label for="user_username">Username</label>
            <input type="text" id="user_username" v-model="user.username" />
        </div>
        <div class="formGroup">
            <button type="submit">Modifier</button>
        </div>
    </form>
</template>

<script>

import userService from "@/services/userService";
import {displayMsg} from "@/utils/toast";
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
