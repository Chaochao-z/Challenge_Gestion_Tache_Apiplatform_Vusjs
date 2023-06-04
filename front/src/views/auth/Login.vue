<script setup>
import {userAuthStore} from "../../stores/auth";
import {displayMsg} from "@/utils/toast";
import router from "../../router";
import {reactive,ref} from "vue";
import InputField from "../../components/Common/InputField.vue";

const formUser = reactive({
    username: '',
    password: ''
});
const is_login = ref(false)


    const onSubmit = async () =>{
        is_login.value=true
        const { username,password } = formUser;
        try {
            if(!username) throw new Error("Veuillez Saisir Username")
            if(!password) throw new Error("Veuillez Saisir Password")

            const res = await userAuthStore().login(username, password)
            if (res === true)
            {
                displayMsg({msg: "Connexion Réussie", type:"success"})
                setTimeout(()=>{
                    router.push('/')

                },2000)

            }else {
                throw new Error("Erreur d'identifiant ou Mot de passe")
            }
        }catch (e) {
            console.error(e)
            displayMsg({msg:e.message, type:'error'})
            is_login.value = false
        }


    }
</script>

<template>
    <h1>Login</h1>
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
            <button type="submit">Connexion</button>
        </div>
    </form>
</template>

<style>

</style>
