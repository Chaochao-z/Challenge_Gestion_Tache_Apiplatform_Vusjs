<template>
    <h1>Listes des utilisateurs</h1>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Création</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="user in users" :key="user.id">
                <td>{{ user.id }}</td>
                <td>{{ user.username }}</td>
                <td>{{ user.mail}}</td>
                <td>{{ user.created }}</td>
            </tr>
        </tbody>
    </table>
</template>

<script>
import userService from "@/services/userService";
    export default {
        name: 'AdminUserIndex',
        data(){
            return{
                users:[]
            }
        },
        mounted() {
            userService.getAllUsers()
                .then(res =>{
                    this.users = res['hydra:member']
                    console.log(this.users)
                })
                .catch(err => console.log(err))
        }
    }
</script>

<style>

</style>
