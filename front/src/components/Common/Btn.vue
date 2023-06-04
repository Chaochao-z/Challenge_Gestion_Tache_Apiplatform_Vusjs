<script setup>
defineProps({
    type: {
        type: String,
        validator: (value) => ["button", "link", "submit"].includes(value),
    },
    to: {
        type: Object,
    },
    outline: {
        type: Boolean,
    },
});
</script>

<template>
    <RouterLink
        v-if="type === 'link'"
        class="button"
        :to="to"
        :class="{
            outline: outline,
        }"
    >
        <slot></slot>
    </RouterLink>
    <button
        v-else
        class="button"
        :class="{
            outline: outline,
        }"
    >
        <slot></slot>
    </button>
</template>

<style lang="scss" scoped>
.button {
    background: var(--primary);
    border: 2px solid transparent;
    border-radius: var(--radius-4);
    color: var(--text-light);
    padding: 0.5rem 1rem;
    font-weight: 600;
    font-size: 1rem;
    text-decoration: none;
    cursor: pointer;
    transition: 0.3s;

    &:hover {
        background: var(--text-light);
        color: var(--primary);
        border-color: var(--primary);
    }

    &.outline {
        background: var(--white);
        border: 2px solid var(--primary);
        color: var(--text-dark);

        &:hover {
            background: var(--primary);
            border: 2px solid var(--white);
            color: var(--white);
        }
    }
}
</style>
