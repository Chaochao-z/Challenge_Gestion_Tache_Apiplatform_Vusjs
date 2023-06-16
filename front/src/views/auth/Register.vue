<template>
    <div class="register">
        <div class="register-center">
            <form @submit.prevent="onSubmit" method="POST" class="bg-light m-auto p-5 rounded" style="width: 800px;">
                <h2 class="text-center">Register</h2>
                <div class="d-flex justify-content-between mt-3 mb-3 align-items-center">
                    <label style="width: 200px">Username</label>
                    <InputField class="form-control" type="text" placeholder="Username" name="username" id="username" v-model="formUser.username" />
                </div>
                <div class="d-flex justify-content-between mt-3 mb-3 align-items-center">
                    <label style="width: 200px">Password</label>
                    <InputField class="form-control" type="password" placeholder="Mots de passe" name="password" id="password" v-model="formUser.password" />
                </div>
                <div class="d-flex justify-content-between mt-3 mb-3 align-items-center">
                    <label style="width: 200px">Password Comfirmation</label>
                    <InputField class="form-control" type="password" placeholder="Mots de passe Confirmation" name="passwordConfirmation" id="passwordConfirmation" v-model="formUser.passwordConfirmation" />
                </div>
                <div class="d-flex justify-content-between mt-3 mb-3 align-items-center">
                    <label style="width: 200px">Email</label>
                    <InputField class="form-control" type="text" placeholder="Email" name="email" id="email" v-model="formUser.email" />
                </div>
                <div class="formGroup">
                    <button class="btn btn-primary" type="submit">Connexion</button>
                </div>
            </form>
        </div>

    </div>

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
            isPasswordStrong(password) {
                const minLength = 8; // Longueur minimale du mot de passe
                const uppercaseRegex = /[A-Z]/; // Au moins une lettre majuscule
                const lowercaseRegex = /[a-z]/; // Au moins une lettre minuscule
                const digitRegex = /\d/; // Au moins un chiffre
                const specialCharRegex = /[$@$!%*?&]/; // Au moins un caractère spécial

                if (password.length < minLength) {
                    return false;
                }

                if (!uppercaseRegex.test(password)) {
                    return false;
                }

                if (!lowercaseRegex.test(password)) {
                    return false;
                }

                if (!digitRegex.test(password)) {
                    return false;
                }

                if (!specialCharRegex.test(password)) {
                    return false;
                }

                return true;
            },
            onSubmit(){

                try {
                    const {username , password,passwordConfirmation,email} = this.formUser
                    if (username.length < 7) {
                        displayMsg({msg:"Veuillez saisir un Username minumun 8 Caractères",type:"error"})
                        throw new Error("Veuillez saisir un Username");
                    }
                    if (password.length < 1) {
                        displayMsg({msg:"Veuillez saisir un mot de passe",type:"error"})
                        throw new Error("Veuillez saisir un mot de passe");
                    }

                    if (!this.isPasswordStrong(password)) {
                        displayMsg({ msg: "Le mot de passe doit être suffisamment fort.", type: "error" });
                        throw new Error("Le mot de passe doit être suffisamment fort.");
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
                        //todo redirect to home
                        setTimeout(() => {
                            router.push({ name: 'homeview' });
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
.register{
    height: 100vh;
    background: linear-gradient(#6e68ee,#20bdce);
    display: flex; /* Utilisez flex pour aligner les éléments */
    justify-content: center; /* Centre horizontalement les éléments */
    align-items: center; /* Centre verticalement les éléments */
}
.register-center{
    background-color: white;
    padding: 30px;
    border-radius: 20px;
}
</style>
