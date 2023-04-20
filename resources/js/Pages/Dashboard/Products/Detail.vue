<script setup>
import { computed } from "vue";
import { Head, usePage } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import DollarIcon from "@/Components/Icons/DollarIcon.vue";
import { useCartStore } from "@/Store/cart";
import { storeToRefs } from "pinia";

const post = computed(() => usePage().props.post);

const cartStore = useCartStore();
const {cart} = storeToRefs(cartStore);

const addToCart = (product) => {
    cart.value.push(product)
}

const isAlreadyInCart = (slug) => {
    let res = cart.value.find(c => c.slug === slug)
    if(res) return true
    return false
}

</script>

<template>
    <Head title="Product Detail" />

    <AuthenticatedLayout>
        <div>
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 mt-10">
                <div class="flex justify-center">
                    <div
                        class="overflow-hidden bg-white rounded-lg shadow-md max-w-fit dark:bg-gray-800"
                    >
                        <img
                            v-if="post.image !== '' && post.image !== null"
                            :v-lazy="`/storage/${post.image}`"
                            class="object-cover w-full"
                            alt="Production Image"
                        />
                        <img
                            v-else
                            v-lazy="'https://source.unsplash.com/800x400?blog'"
                            class="object-cover w-full h-[23rem]"
                            alt="Production Image"
                        />

                        <div class="p-6">
                            <div>
                                <span
                                    class="text-lg gap-2 font-medium text-blue-600 uppercase dark:text-blue-400 flex items-center"
                                    >
                                    <DollarIcon />
                                    {{ post.price }}
                                </span
                                >
                                <h1
                                    class="block mt-2 text-2xl font-semibold text-gray-800 dark:text-white hover:text-gray-600 hover:underline max-w-max"
                                >
                                    {{ post.title }}
                                </h1>
                                <div
                                    class="mt-2 prose prose-dark dark:prose-invert lg:prose-lg"
                                    v-html="post.body"
                                />
                            </div>

                            <div class="mt-4">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <img
                                            class="object-cover h-10 rounded-full"
                                            src="https://images.unsplash.com/photo-1586287011575-a23134f797f9?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=48&q=60"
                                            alt="Avatar"
                                        />
                                        <a
                                            href="#"
                                            class="mx-2 font-semibold text-gray-700 dark:text-gray-200"
                                            tabindex="0"
                                            role="link"
                                            >{{ post.author }}</a
                                        >
                                        
                                        <span
                                            class="mx-1 text-xs text-gray-600 dark:text-gray-300"
                                        >
                                            {{ post.created_at }}
                                        </span>
                                    </div>
                                    <div class="block">
                                        <button
                                            :disabled="isAlreadyInCart(post.slug)"
                                            class="flex items-center justify-center px-3 py-1 space-x-2 text-center text-white shadow-lg cursor-pointer bg-cyan-500 shadow- shadow-cyan-600 rounded-xl"
                                            @click="addToCart(post)"
                                        >
                                            <TagIcon />
                                            <span v-if="isAlreadyInCart(post.slug)">Item added</span>
                                            <span v-else>Add to cart</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
