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
            if(!password)
            {
                const aze = document.getElementById("passwordLabel")
                aze.style.color = "red"
                throw new Error("Veuillez Saisir Password")
            }

            const res = await userAuthStore().login(username, password)
            if (res)
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
    <div class="login">
        <div class="login-center">
            <h1 class="text-center">Login</h1>
            <form @submit.prevent="onSubmit" method="POST" class="bg-light m-auto p-5 rounded" style="width: 800px;">
                <div class="d-flex justify-content-between mt-3 mb-3 align-items-center">
                    <label  style="width: 200px">Username</label>
                    <InputField class="form-control" type="text" placeholder="Username" name="username" id="username" v-model="formUser.username" />
                </div>
                <div class="d-flex justify-content-between mt-3 mb-3 align-items-center">
                    <label  style="width: 200px" id="passwordLabel">Password</label>
                    <InputField class="form-control" type="password" placeholder="Mots de passe" name="password" id="password" v-model="formUser.password" />
                </div>
                <div class="formGroup">
                    <button class="btn btn-primary" type="submit">Connexion</button>
                </div>
            </form>
        </div>
    </div>
</template>

<style>
.login{
    height: 100vh;
    background: linear-gradient(#6e68ee,#20bdce);
    display: flex; /* Utilisez flex pour aligner les éléments */
    justify-content: center; /* Centre horizontalement les éléments */
    align-items: center; /* Centre verticalement les éléments */
}
.login-center{
    background-color: white;
    padding: 30px;
    border-radius: 20px;
}
</style>
