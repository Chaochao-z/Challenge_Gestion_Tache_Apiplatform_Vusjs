<script setup>
import { ref, onMounted, computed } from "vue";
import { useRoute, useRouter  } from "vue-router";
import userService from "@/services/userService";
import { displayMsg } from "@/utils/toast";

const router = useRouter();
const route = useRoute();
const token = route.params.token;
const loading = ref(true);
const error = ref("");

onMounted(() => {
    userService.verifyAccount({token}).then((res) => {
        if (!res) {
            error.value = "User not found or invalid token";
            loading.value = false;
        }else{
            loading.value = false;
            displayMsg({ msg: "Addresse email vérifiée !", type: "success" });
            setTimeout(() => {
                router.push({ name: 'login' });
            }, 2000);
        }
    });
})
</script>
<template>
    <section v-if="loading">Loading...</section>
    <template v-else>
        <h1>Verify your account</h1>
        <section v-if="error">
            <p>{{ error }}</p>
        </section>
        <section v-else>
            <p>Account verified</p>
        </section>
    </template>
</template>
