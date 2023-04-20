<script setup lang="ts">
    defineProps({
        sidebar: {
            type: String,
            default: "text-indigo-500",
        },
    });
</script>

<template>
    <svg
        v-if="sidebar"
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 24 24"
        stroke-width="1.5"
        class="w-5 h-5 text-indigo-500 -rotate-90 stroke-current dark:text-gray-100"
    >
        <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M3 4.5h14.25M3 9h9.75M3 13.5h5.25m5.25-.75L17.25 9m0 0L21 12.75M17.25 9v12"
        />
    </svg>
    
    <svg
        v-else
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 24 24"
        stroke-width="1.5"
        class="w-5 h-5 text-indigo-500 -rotate-90 stroke-current dark:text-gray-100"
    >
        <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M3 4.5h14.25M3 9h9.75M3 13.5h9.75m4.5-4.5v12m0 0l-3.75-3.75M17.25 21L21 17.25"
        />
    </svg>
</template>