<script setup>
import { onMounted, onUnmounted, reactive, ref, computed } from "vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, router } from "@inertiajs/vue3";

import { useCartStore } from "@/Store/cart";
import { storeToRefs } from "pinia";
import ToastNotification from "@/Components/ToastNotification.vue";

const cartStore = useCartStore();
const { cart } = storeToRefs(cartStore);

const removeFromCart = (id) => {
    cartStore.removeProductFromCart(id);
};

const total = computed(() => {
    let total = 0;
    cart.value.forEach((c) => {
        total += c.price;
    });
    if (total > 0) {
        return total.toFixed(2);
    }
    return 0;
});

const totalWithoutDot = () => {
    let num = String(total.value).split(".").join("");
    return Number(num);
};
</script>

<template>
    <Head title="Products" />

    <ToastNotification />
    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-bold leading-tight text-gray-800 dark:text-gray-200"
            >
                Shopping Cart
            </h2>
        </template>

        <div class="flex gap-4 ml-2">
            <div class="w-full bg-white dark:bg-gray-800 p-4 mt-4">
                <div class="border-b">
                    <div
                        class="text-sm w-full flex justify-end items-center font-semibold text-cyan-900 dark:text-cyan-500"
                    >
                        Price
                    </div>
                </div>
                <div
                    v-if="!cart.length"
                    class="text-center font-bold text-2xl py-20 text-cyan-900 dark:text-cyan-500"
                >
                    Your FixForm Cart is empty
                </div>
                <div
                    v-for="product in cart"
                    v-else
                    :key="product"
                    class="flex border-b"
                >
                    <img :src="product.image" class="h-[180px] mt-4 mb-4" />
                    <div class="flex justify-between mb-4">
                        <div class="pl-8 py-10 relative">
                            <div
                                class="text-cyan-900 dark:text-cyan-500 pb-2 -mt-4 font-bold text-[18px]"
                            >
                                {{ product.title }}
                            </div>
                            <span class="prose prose-gray dark:prose-invert"
                                >{{ product.body.substring(0, 180) }}...</span
                            >
                            <div class="text-teal-600 py-2">In Stock</div>
                            <div
                                class="text-teal-600 absolute bottom-0 mb-4 flex items-center"
                            >
                                <div
                                    class="text-sm hover:underline cursor-pointer"
                                    @click="removeFromCart(product.slug)"
                                >
                                    Delete
                                </div>
                            </div>
                        </div>
                        <div class="py-10 justify-end">
                            <div
                                class="font-bold pl-20 text-cyan-900 dark:text-cyan-500"
                            >
                                ${{ product.price }}
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    class="font-extrabold text-[18px] pt-4 text-right text-cyan-900 dark:text-cyan-500"
                >
                    Subtotal (Items: {{ cart.length }}): ${{ total }}
                </div>
            </div>
            <div class="bg-white dark:bg-gray-800 w-[350px] p-4 mt-4 h-auto">
                <div class="text-sm text-green-700">
                    Welcome to Fixform! FREE Delivery on your first order to
                    anywhere
                </div>
                <div
                    class="font-extrabold text-[18px] pt-4 text-cyan-900 dark:text-cyan-500"
                >
                    Subtotal (Items: {{ cart.length }}): ${{ total }}
                </div>

                <Link
                    class="block mt-4 w-full text-center py-1 font-bold text-sm rounded-lg border shadow-sm cursor-pointer"
                    :disabled="Number(total) === 0.0"
                    :class="
                        Number(total) === 0.0
                            ? 'bg-gray-400'
                            : 'bg-yellow-400 hover:bg-yellow-500'
                    "
                    as="button"
                    method="post"
                    :href="
                        $page.props.auth.user !== null
                            ? route('cart.store', {
                                  total: totalWithoutDot(),
                                  total_decimal: total,
                                  items: cart,
                              })
                            : route('login')
                    "
                    >Proceed to Checkout
                </Link>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
