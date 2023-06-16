<template>
    <div class="d-flex">
        <div class="admin-sidebar d-flex flex-column align-items-center">
            <svg class="mt-4 mb-5" xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 24 24"><path fill="#11caf0" d="m10.95 18l5.65-5.65l-1.45-1.45l-4.225 4.225l-2.1-2.1L7.4 14.45L10.95 18ZM4 22V2h10l6 6v14H4Zm9-13h5l-5-5v5Z"/></svg>
            <div style="width: 150px;border-bottom: 4px solid white" class="mb-3"></div>

            <a href="/admin/taches" class="text-decoration-none text-light fw-semibold">
            <div class="admin-sidebar-col d-flex align-items-center pt-3 pb-3 px-5 rounded-pill" style="gap: 10px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="white" d="M12 22q-2.075 0-3.9-.788t-3.175-2.137q-1.35-1.35-2.137-3.175T2 12q0-2.075.788-3.9t2.137-3.175q1.35-1.35 3.175-2.137T12 2q1.625 0 3.075.475T17.75 3.8L16.3 5.275q-.95-.6-2.025-.938T12 4Q8.675 4 6.337 6.337T4 12q0 3.325 2.337 5.663T12 20q3.325 0 5.663-2.337T20 12q0-.45-.05-.9t-.15-.875L21.425 8.6q.275.8.425 1.65T22 12q0 2.075-.788 3.9t-2.137 3.175q-1.35 1.35-3.175 2.138T12 22Zm-1.4-5.4l-4.25-4.25l1.4-1.4l2.85 2.85l10-10.025l1.4 1.4L10.6 16.6Z"/></svg>
                Taches
            </div>
            </a>
            <a href="/admin/liste-taches" class="text-decoration-none text-light fw-semibold"><div class="admin-sidebar-col d-flex align-items-center pt-3 pb-3 px-5 rounded-pill" style="gap: 10px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="white" d="M3 13h2v-2H3v2zm0 4h2v-2H3v2zm0-8h2V7H3v2zm4 4h14v-2H7v2zm0 4h14v-2H7v2zM7 7v2h14V7H7z"/></svg>
                Listes
            </div>
            </a>
            <a href="/admin/users" class="text-decoration-none text-light fw-semibold">
            <div class="admin-sidebar-col d-flex align-items-center pt-3 pb-3 px-5 rounded-pill" style="gap: 10px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="white" d="M16 17v2H2v-2s0-4 7-4s7 4 7 4m-3.5-9.5A3.5 3.5 0 1 0 9 11a3.5 3.5 0 0 0 3.5-3.5m3.44 5.5A5.32 5.32 0 0 1 18 17v2h4v-2s0-3.63-6.06-4M15 4a3.39 3.39 0 0 0-1.93.59a5 5 0 0 1 0 5.82A3.39 3.39 0 0 0 15 11a3.5 3.5 0 0 0 0-7Z"/></svg>
                Users
            </div></a>
            <button type="button" @click="logout()" class="text-decoration-none text-light fw-semibold" style="background-color: transparent;border: none">
                <div class="admin-sidebar-col d-flex align-items-center pt-3 pb-3 px-5 rounded-pill" style="gap: 10px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="white" d="m16 17l-1.375-1.45l2.55-2.55H9v-2h8.175l-2.55-2.55L16 7l5 5l-5 5ZM3 21V3h9v2H5v14h7v2H3Z"/></svg>                    Déconnexion
                </div></button>
        </div>

        <RouterView />
    </div>

</template>

<script>
    import {userAuthStore} from "@/stores/auth";

    export default {
        name: 'AdminLayout',
        data(){
            return{
                authUser : userAuthStore()
            }
        },
        methods:{
            logout(){
                this.authUser.logout()
            }
        }
    }
</script>

<style>
.admin-sidebar{
    width: 220px;
    background-color: #323030;
    height: 100vh;
}

.admin-sidebar-col:hover
{background-color: blue}

</style>
