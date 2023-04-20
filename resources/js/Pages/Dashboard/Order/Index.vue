<script setup>
import { onMounted, onUnmounted, reactive, ref, computed } from "vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, router } from "@inertiajs/vue3";

const props = defineProps({
    orders: Object,
});
</script>

<template>
    <Head title="Products" />
    
    <ToastNotification />
    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-bold leading-tight text-gray-800 dark:text-gray-200"
            >
            Order History
            </h2>
        </template>
        
        <div class="flex gap-4 mx-2">
            <div class="w-full bg-white dark:bg-gray-800 p-4 mt-4">
                <div
                    v-if="!orders?.length"
                    class="text-center font-bold text-2xl py-20 text-cyan-900 dark:text-cyan-500"
                >
                    Your order history is empty
                </div>
                <div
                    v-for="stepOrder in orders"
                    v-else
                    :key="stepOrder"
                >
									<div
										v-for="order in stepOrder"
                    :key="order"
										class="flex border-b"
									>
									<div class="flex justify-between mb-4">
                        <div class="pl-8 py-10 relative">
                            <div
                                class="text-cyan-900 dark:text-cyan-500 pb-2 -mt-4 font-bold text-[18px]"
                            >
                                {{ order.title }}
                            </div>
                            <span class="prose prose-gray dark:prose-invert"
                                >{{
                                    order?.body?.substring(0, 180)
                                }}...</span
                            >
                        </div>
                        <div class="py-10 justify-end">
                            <div class="font-bold pl-20 text-cyan-900 dark:text-cyan-500">
                                ${{ order.price }}
                            </div>
                        </div>
                        <div class="py-10 justify-end">
                            <div class="font-bold pl-20 text-cyan-900 dark:text-cyan-500">
                                {{ order.created_at }}
                            </div>
                        </div>
                    </div>
									</div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
