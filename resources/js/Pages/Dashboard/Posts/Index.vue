<script setup>
import { Head, Link, router } from "@inertiajs/vue3";
import { ref, watch, onMounted, onUnmounted, reactive } from "vue";
import { truncate, debounce } from "lodash";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import CloseIcon from "@/Components/Icons/CloseIcon.vue";
import DeleteModal from "./Partials/DeleteModal.vue";
import InputLabel from "@/Components/InputLabel.vue";
import Pagination from "@/Components/DashboardPagination.vue";
import ToastNotification from "@/Components/ToastNotification.vue";
import TableButton from "@/Components/TableButton.vue";

const props = defineProps({
    posts: Object,
    filters: Object,
    categories: Object,
    authors: Object,
});

/**
 * Search input value and watch for changes
 */
const form = reactive({
    search: props.filters.search,
    author: props.filters.author,
});

watch(
    form,
    debounce((value) => {
        router.get(
            route("dashboard.posts.index"),
            {
                search: value.search,
                category: value.category,
                author: value.author,
            },
            {
                preserveState: true,
                replace: true,
            }
        );
    }, 500)
);

/**
 * Reset search input
 */
const reset = () => {
    form.search = "";
    form.category = "";
    form.author = "";
};

const data = reactive({
    slugs: null,
});

const isOpen = ref(false);

const openModal = (slug) => {
    data.slugs = slug;
};

const closeModal = () => {
    data.slugs = null;
};

const openFilter = () => {
    isOpen.value = true;
};

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
</script>

<template>
    <Head title="Posts" />

    <AuthenticatedLayout>
        <ToastNotification />

        <template #header>
            <Link
                :href="route('dashboard.posts.index')"
                class="text-xl font-bold leading-tight text-gray-800 cursor-pointer dark:text-gray-200"
            >
                Manage Products
            </Link>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-900"
                >
                    <div
                        class="p-4 bg-white border-b border-gray-200 dark:border-b-0 dark:bg-gray-900"
                    >
                        <div
                            class="flex flex-col md:items-center md:justify-between gap-y-2 md:gap-y-0 md:flex-row"
                        >
                            <div class="flex items-center gap-2">
                                <div class="flex items-center gap-1">
                                    <input
                                        v-model="form.search"
                                        type="text"
                                        class="block w-full px-3 py-2 text-sm border-gray-200 rounded-md shadow-sm md:w-72 focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400"
                                        placeholder="Search by title, content, or price"
                                    />
                                    <button
                                        v-if="
                                            form.search ||
                                            form.author
                                        "
                                        type="button"
                                        class="p-1 transition ease-in bg-white rounded-lg dark:bg-gray-800 dark:hover:bg-gray-700"
                                        @click="reset()"
                                    >
                                        <CloseIcon />
                                    </button>
                                </div>
                            </div>
                            <Link
                                :href="route('dashboard.posts.create')"
                                class="px-4 py-2 text-base font-semibold text-center text-white transition duration-200 ease-in bg-indigo-600 rounded-lg shadow-md w-52 hover:bg-teal-600 focus:ring-teal-500 focus:ring-offset-teal-200 dark:focus:ring-offset-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2"
                            >
                                Create
                            </Link>
                        </div>

                        <!-- Table -->
                        <div class="flex flex-col mt-5">
                            <div class="overflow-x-auto">
                                <div
                                    class="inline-block min-w-full align-middle"
                                >
                                    <div
                                        class="overflow-hidden border rounded-lg dark:border-gray-700"
                                    >
                                        <table
                                            class="min-w-full divide-y divide-gray-200 dark:divide-gray-700"
                                        >
                                            <thead
                                                class="bg-gray-50 dark:bg-gray-900/50"
                                            >
                                                <tr>
                                                    <th
                                                        scope="col"
                                                        class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-200"
                                                    >
                                                        Title
                                                    </th>
                                                    <th
                                                        scope="col"
                                                        class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-200"
                                                    >
                                                        User
                                                    </th>
                                                    <th
                                                        scope="col"
                                                        class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-200"
                                                    >
                                                        Price
                                                    </th>
                                                    <th
                                                        scope="col"
                                                        class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-200"
                                                    >
                                                        Created at
                                                    </th>
                                                    <th
                                                        scope="col"
                                                        class="px-6 py-3 text-xs font-medium text-right text-gray-500 uppercase dark:text-gray-200"
                                                    >
                                                        Action
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody
                                                class="divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-800"
                                            >
                                                <tr
                                                    v-for="post in posts.data"
                                                    v-if="posts.total > 0"
                                                    :key="post.id"
                                                >
                                                    <td
                                                        class="px-6 py-4 text-sm font-medium text-gray-800 whitespace-nowrap dark:text-gray-200"
                                                    >
                                                        {{
                                                            truncate(post.title)
                                                        }}
                                                    </td>
                                                    <td
                                                        class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-gray-200"
                                                    >
                                                        {{ post.author }}
                                                    </td>
                                                    <td
                                                        class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-gray-200"
                                                    >
                                                        {{ post.price }}
                                                    </td>
                                                    <td
                                                        class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap dark:text-gray-200"
                                                    >
                                                        {{ post.created_at }}
                                                    </td>
                                                    <td
                                                        class="flex items-center float-right px-6 py-4 space-x-2 text-sm font-medium text-right whitespace-nowrap"
                                                    >
                                                        <Link
                                                            :href="
                                                                route(
                                                                    'dashboard.posts.show',
                                                                    post
                                                                )
                                                            "
                                                        >
                                                            <TableButton
                                                                value="Detail"
                                                                type-button="btnDetail"
                                                            />
                                                        </Link>
                                                        <Link
                                                            :href="
                                                                route(
                                                                    'dashboard.posts.edit',
                                                                    post
                                                                )
                                                            "
                                                        >
                                                            <TableButton
                                                                value="Edit"
                                                                type-button="btnEdit"
                                                            />
                                                        </Link>
                                                        <TableButton
                                                            type="button"
                                                            value="Delete"
                                                            type-button="btnDelete"
                                                            @click="
                                                                openModal(
                                                                    post.slug
                                                                )
                                                            "
                                                        />
                                                    </td>
                                                </tr>
                                                <tr v-else>
                                                    <td
                                                        colspan="5"
                                                        class="py-4 text-sm text-center text-gray-500 dark:text-gray-200"
                                                    >
                                                        No products found
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <DeleteModal
                            title="Delete Post"
                            body="Are you sure you want to delete this post?"
                            :slug="data.slugs"
                            @close="closeModal"
                        />

                        <Pagination
                            class="mt-6"
                            :links="posts.links"
                            :total="posts.total"
                        />
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.5s;
}
.fade-enter,
.fade-leave-to {
    opacity: 0;
}
.fade-enter-to,
.fade-leave {
    opacity: 1;
}
</style>
