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
            <label>Password Comfirmation</label>
            <InputField type="password" placeholder="Mots de passe Confirmation" name="passwordConfirmation" id="passwordConfirmation" v-model="formUser.passwordConfirmation" />
        </div>
        <div class="formGroup">
            <label>Email</label>
            <InputField type="text" placeholder="Email" name="email" id="email" v-model="formUser.email" />
        </div>
        <div class="formGroup">
            <button type="submit">Connexion</button>
        </div>
    </form>
</template>

<script>
import InputField from "@/components/Common/InputField.vue";
import {userAuthStore} from "@/stores/auth";
import {displayMsg} from "@/utils/toast";
import router from "@/router";

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

            },
            store: userAuthStore()
        }
    },
    methods:
        {
            onSubmit(){

                try {
                    const {username , password,passwordConfirmation,email} = this.formUser
                    if (username.length < 1) {
                        displayMsg({msg:"Veuillez saisir un Username",type:"error"})
                        throw new Error("Veuillez saisir un Username");
                    }
                    if (password.length < 1) {
                        displayMsg({msg:"Veuillez saisir un mot de passe",type:"error"})
                        throw new Error("Veuillez saisir un mot de passe");
                    }

                    if (password !== passwordConfirmation) {
                        displayMsg({msg:"Les mots de passe ne correspondent pas",type:"error"})
                        throw new Error("Les mots de passe ne correspondent pas");
                    }

                    const emailRegex = /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/;
                    if (!emailRegex.test(email))
                    {
                        displayMsg({msg:"Entrée un Email Valide",type:"error"})
                        throw new Error("Entrée un Email Valide");
                    }

                    const res = this.store.register({ ...this.formUser, role: "ROLE_USER" });
                    if (res) {
                        displayMsg({ msg: "Inscription réussie", type: "success" });
                        //todo redirect to home
                        setTimeout(() => {
                            router.push({ name: 'home' });
                        }, 2000);
                    }else{
                        throw new Error("Une erreur est survenue lors de l'inscription");
                    }
                }
                catch (e){
                    console.log(e)
                }
            }
        }
}
</script>

<style scoped>

</style>
