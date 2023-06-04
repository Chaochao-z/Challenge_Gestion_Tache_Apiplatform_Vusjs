<template>
    <form @submit.prevent="onSubmit" method="POST">
        <div class="formGroup">
            <label>Username</label>
            <InputField type="text" placeholder="Username" name="username" id="username" v-model="formUser.username" />
        </div>
        <div class="formGroup">
            <label>Password</label>
            <InputField type="password" placeholder="Mots de passe" name="password" id="password" v-model="formUser.password" />
        </div>
        <div class="formGroup">
            <label>Password</label>
            <InputField type="password" placeholder="Mots de passe Confirmation" name="passwordConfirmation" id="passwordConfirmation" v-model="formUser.passwordConfirmation" />
        </div>
        <div class="formGroup">
            <label>Password</label>
            <InputField type="text" placeholder="Email" name="email" id="email" v-model="formUser.email" />
        </div>
        <div class="formGroup">
            <button type="submit">Connexion</button>
        </div>
    </form>
</template>

<script>
import InputField from "@/components/Common/InputField.vue";

export default {
    name: "Register",
    components: {InputField},
    data(){
        return{
            formUser:{
                username:"",
                password:"",
                passwordConfirmation:"",
                email: ""

            }
        }
    },
    methods:
        {
            onSubmit(){

            }
        }
}
</script>

<style scoped>

</style>
