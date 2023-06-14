<template>
    <h1>Listes des utilisateurs</h1>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Création</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="user in users" :key="user.id">
                <td>{{ user.id }}</td>
                <td>{{ user.username }}</td>
                <td>{{ user.mail}}</td>
                <td>{{ moment(user.CreatedAt).format("DD-MM-YYYY") }}</td>
                <td> <Btn :type="'link'" :to="{ name: 'admin-user', params: { id: user.id } }">See or edit</Btn>
                </td>
            </tr>
        </tbody>
    </table>
</template>

<script>
import userService from "@/services/userService";
import moment from "moment";
import Btn from "@/components/Common/Btn.vue";
    export default {
        name: 'AdminUserIndex',
        components: {Btn},
        data(){
            return{
                users:[],
                moment
            }
        },
        mounted() {
            userService.getAllUsers()
                .then(res =>{
                    this.users = res['hydra:member']
                    console.log(res['hydra:member'])
                })
                .catch(err => console.log(err))
        }
    }
</script>

<style>

</style>
