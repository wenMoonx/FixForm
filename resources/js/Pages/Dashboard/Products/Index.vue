<script setup>
import { onMounted, onUnmounted, reactive, ref, watch, computed } from "vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, router } from "@inertiajs/vue3";
import { truncate, debounce } from "lodash";
import CloseIcon from "@/Components/Icons/CloseIcon.vue";
import Pagination from "@/Components/MainPagination.vue";
import DollarIcon from "@/Components/Icons/DollarIcon.vue";
import SearchIcon from "@/Components/Icons/SearchIcon.vue";
import TagIcon from "@/Components/Icons/TagIcon.vue";

import { useCartStore } from "@/Store/cart";
import { storeToRefs } from "pinia";


const props = defineProps({
    posts: Object,
    categories: Object,
    authors: Object,
    filters: Object,
});

const cartStore = useCartStore();
const {cart} = storeToRefs(cartStore);

const form = reactive({
    search: props.filters.search,
    category: props.filters.category,
    author: props.filters.author,
});

watch(
    form,
    debounce((value) => {
        router.get(
            route("product.index"),
            {
                search: value.search,
                author: value.author,
            },
            {
                preserveState: true,
                replace: true,
            }
        );
    }, 500),
    { deep: true }
);

const isOpen = ref(false);

const closeFilter = () => {
    isOpen.value = false;
};

const closeOnEscape = (e) => {
    if (e.key === "Escape" && isOpen.value) {
        closeFilter();
    }
};

onMounted(() => document.addEventListener("keydown", closeOnEscape));

onUnmounted(() => {
    document.removeEventListener("keydown", closeOnEscape);
});

/**
 * Reset search & category filters
 */
const reset = () => {
    form.search = "";
};

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

    <Head title="Products" />
    
    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-bold leading-tight text-gray-800 dark:text-gray-200"
            >
                Products
            </h2>
        </template>
        <div
            class="container min-h-screen px-0 sm:mx-auto sm:px-7 dark:text-gray-100 mt-10"
        >
            <div class="flex flex-col sm:gap-2 sm:flex-row item-center">
                <div class="relative w-full px-3 mb-5 sm:px-0 sm:max-w-sm">
                    <input
                        v-model="form.search"
                        type="text"
                        class="block w-full px-5 py-3 text-sm border-gray-300 rounded-full focus:border-cyan-500 focus:ring-cyan-500 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400"
                        placeholder="Search by title, content, or price..."
                    />
                    <SearchIcon :search="form.search" />
                    <div
                        v-if="form.search"
                        class="absolute p-1 rounded-full cursor-pointer bg-slate-200 dark:bg-slate-700 right-6 bottom-2.5 sm:right-3"
                        @click="reset()"
                    >
                        <CloseIcon class="w-6 h-6 fill-cyan-500" />
                    </div>
                </div>
            </div>

            <div
                v-if="posts.data.length > 0"
                class="grid gap-x-2 gap-y-6 xl:grid-cols-2"
            >
                <div
                    v-for="post in posts.data"
                    :key="post.id"
                    class="p-4 items-center justify-center sm:w-[680px] rounded-xl group sm:flex space-x-6 bg-gray-50 dark:bg-gray-800 bg-opacity-50 shadow-xl hover:rounded-2xl"
                >
                    <img
                        v-if="post.image !== '' && post.image !== null"
                        :v-lazy="`/storage/${post.image}`"
                        class="block object-cover w-full h-40 mx-auto rounded-lg sm:w-4/12"
                        loading="lazy"
                        alt="Production Image"
                    />
                    <img
                        v-else
                        v-lazy="'https://picsum.photos/seed/2/2000/1000'"
                        class="block object-cover w-full h-40 mx-auto rounded-lg sm:w-4/12"
                        alt="art cover"
                        loading="lazy"
                    />
                    <div class="p-5 pl-0 sm:w-8/12">
                        <div class="space-y-2">
                            <Link
                                :href="route('product.show', post.slug)"
                                class=""
                            >
                                <h4
                                    class="font-semibold text-justify text-md text-cyan-900 dark:text-cyan-500"
                                >
                                    {{ post.title }}
                                </h4>
                                <p
                                    class="text-sm prose text-justify prose-gray dark:prose-invert"
                                    v-html="
                                        truncate(post.body, {
                                            length: 100,
                                            separator: /,? +/,
                                        })
                                    "
                                />
                            </Link>
                            <div>
                                <div class="flex gap-1 space-y-1 items-center">
                                    <DollarIcon />
                                    {{ post.price }}
                                </div>
                            </div>
                            <div
                                class="flex items-center justify-between space-x-4"
                            >
                                <div
                                    class="flex flex-row my-1 space-x-1 text-grey-500"
                                >
                                    <svg
                                        stroke="currentColor"
                                        fill="none"
                                        stroke-width="0"
                                        viewBox="0 0 24 24"
                                        height="1em"
                                        width="1em"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"
                                        ></path>
                                    </svg>
                                    <p class="text-xs">{{ post.created_at }}</p>
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

            <div
                v-if="posts.data.length === 0"
                class="flex items-center justify-center w-full h-full gap-3"
            >
                <h1 class="text-2xl font-semibold text-center animate-bounce">
                    No products found
                </h1>
            </div>
            <Pagination class="mt-12" :links="posts.links" />
        </div>
    </AuthenticatedLayout>
</template>
