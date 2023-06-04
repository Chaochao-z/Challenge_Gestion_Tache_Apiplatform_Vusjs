<script setup>
import { RouterLink, RouterView } from 'vue-router'
import HelloWorld from './components/HelloWorld.vue'
import {userAuthStore} from "@/stores/auth";
import {onMounted} from "vue";

const store = userAuthStore();

onMounted(() => {
    store.tryLogin();
})
</script>

<template>
  <RouterView />
</template>

<style scoped>

</style>
