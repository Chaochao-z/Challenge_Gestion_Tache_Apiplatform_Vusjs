<script setup>
defineProps({
    modelValue: {
        type: String,
        required: true,
    },
    placeholder: {
        type: String,
        default: '',
    }
});

const emit = defineEmits(['update:modelValue']);
</script>

<template>
    <input type="text" :value="modelValue" @input="emit('update:modelValue', $event.target.value)" :placeholder="placeholder"/>
</template>

<style scoped>

</style>
