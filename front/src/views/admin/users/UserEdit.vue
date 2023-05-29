<template>
    <div>
        This is User N° {{ id }}
    </div>
</template>

<script>
export default {
    name: 'userindex',
    props: ['id'],
    data(){
        return{
            test: ''
        }
    },
}
</script>

<style>

</style>
