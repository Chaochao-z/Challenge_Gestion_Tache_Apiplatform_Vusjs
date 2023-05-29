<template>
    <h1>Login</h1>
    {{ user.username }}
    <form @submit.prevent="login" method="POST">
        <div class="formGroup">
            <label>Username</label>
            <input type="text" name="username" id="username" v-model="user.username">
        </div>
        <div class="formGroup">
            <label>Password</label>
            <input type="password" name="password" id="password" v-model="user.password">
        </div>
        <div class="formGroup">
            <button type="submit">Connexion</button>
        </div>
    </form>
</template>

<script>
    export default {
        name: 'Login',
        data(){
          return{
              user:{
                  username:'',
                  password:''
              }
          }
        },
        methods:{
            login(){
                console.log('stop form')
                console.log(this.user)
            }
        }
    }
</script>

<style>

</style>
