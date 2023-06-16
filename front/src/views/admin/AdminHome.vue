<template>
    <div class="adminHome" style="width: 100%">
        <div class="adminHome-center">
            <h1>Bienvenue Dans l'interface Administrateur</h1>
        </div>
    </div>
</template>

<script>
export default {
    name: 'AdminHome'
}
</script>

<style>
.adminHome{
    height: 100vh;
    background: linear-gradient(#6e68ee,#20bdce);
    display: flex; /* Utilisez flex pour aligner les éléments */
    justify-content: center; /* Centre horizontalement les éléments */
    align-items: center; /* Centre verticalement les éléments */
}
.adminHome-center{
    background-color: white;
    padding: 30px;
    border-radius: 20px;
}
</style>
