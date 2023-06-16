<template>
    <div class="p-5 adminIndexBox" style="width: 100%">
        <div class="d-flex justify-content-between">
            <h1 class="text-light"> Les Users</h1>


        </div>

        <div class="adminScrollBox">
            <div v-for="user in users" :key="user.id" class="adminBlockShow">
                <h1 class="text-center">{{ user.username }}</h1>
                <div class="d-flex justify-content-between align-items-center">
                    <p style="height: 60px;overflow-y: scroll;">{{ user.email }}</p>
                </div>
                <div class="d-flex justify-content-between">
                    <p>Date de Création Compte : {{ moment(user.createdAt).format("DD / MM /YYYY") }}</p>
                    <div>
                        <a :href="`/admin/user/edit/${user.id}`"><svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24"><path fill="#11caf0" d="m18.988 2.012l3 3L19.701 7.3l-3-3zM8 16h3l7.287-7.287l-3-3L8 13z"/><path fill="#11caf0" d="M19 19H8.158c-.026 0-.053.01-.079.01c-.033 0-.066-.009-.1-.01H5V5h6.847l2-2H5c-1.103 0-2 .896-2 2v14c0 1.104.897 2 2 2h14a2 2 0 0 0 2-2v-8.668l-2 2V19z"/></svg></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!--            <tr v-for="user in users" :key="user.id">-->
<!--                <td>{{ user.id }}</td>
                <td>{{ user.username }}</td>
                <td>{{ user.mail}}</td>
                <td>{{ moment(user.CreatedAt).format("DD-MM-YYYY") }}</td>
                <td> <Btn :type="'link'" :to="{ name: 'admin-user', params: { id: user.id } }">See or edit</Btn>-->

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
