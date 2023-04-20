<script setup lang="ts">
    defineProps({
        search: {
            type: Boolean,
        },
    });
</script>

<template>
    <svg
        v-if="!search"
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 24 24"
        fill="currentColor"
        class="absolute w-6 h-6 right-6 bottom-2.5 sm:right-3 fill-cyan-500"
    >
        <path
            fill-rule="evenodd"
            d="M10.5 3.75a6.75 6.75 0 100 13.5 6.75 6.75 0 000-13.5zM2.25 10.5a8.25 8.25 0 1114.59 5.28l4.69 4.69a.75.75 0 11-1.06 1.06l-4.69-4.69A8.25 8.25 0 012.25 10.5z"
            clip-rule="evenodd"
        />
    </svg>
</template>