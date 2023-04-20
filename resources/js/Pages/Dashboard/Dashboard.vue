<script setup>
import CategoryIcon from "@/Components/Icons/CategoryIcon.vue";
import PermissionsIcon from "@/Components/Icons/PermissionsIcon.vue";
import PostsIcon from "@/Components/Icons/PostsIcon.vue";
import RolesIcon from "@/Components/Icons/RolesIcon.vue";
import UsersIcon from "@/Components/Icons/UsersIcon.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, usePage } from "@inertiajs/vue3";
// import { computed } from "vue";

// const username = computed(() => usePage().props.auth.user.name);
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-bold leading-tight text-gray-800 dark:text-gray-200"
            >
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-xl dark:bg-gray-800"
                >
                    <div
                        class="p-6 bg-white border-b border-gray-200 dark:text-gray-200 dark:bg-gray-800 dark:border-b-0"
                    >
                        Welcome to Dashboard,
                        {{ $page.props.auth.user.name }}!
                    </div>
                </div>

                <div class="grid grid-cols-4 gap-3 mt-5">
                    <div class="col-span-4 sm:col-span-1">
                        <div
                            class="overflow-hidden bg-white shadow-sm sm:rounded-xl dark:bg-gray-800"
                        >
                            <div
                                class="p-6 bg-white border-b border-gray-200 dark:text-gray-200 dark:bg-gray-800 dark:border-b-0"
                            >
                                <h2
                                    class="mb-3 text-xl font-semibold leading-tight tracking-wider text-gray-800 dark:text-gray-200"
                                >
                                    Productions
                                </h2>
                                <div class="flex items-center">
                                    <div class="p-2 bg-indigo-200 rounded-full">
                                        <PostsIcon
                                            class="w-8 h-8 fill-indigo-600"
                                        />
                                    </div>
                                    <div class="flex flex-col ml-2">
                                        <div class="text-xl font-semibold">
                                            0
                                        </div>
                                        <div
                                            class="text-sm font-bold text-indigo-600"
                                        >
                                            Total Posts
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-4 sm:col-span-1">
                        <div
                            class="overflow-hidden bg-white shadow-sm sm:rounded-xl dark:bg-gray-800"
                        >
                            <div
                                class="p-6 bg-white border-b border-gray-200 dark:text-gray-200 dark:bg-gray-800 dark:border-b-0"
                            >
                                <h2
                                    class="mb-3 text-xl font-semibold leading-tight tracking-wider text-gray-800 dark:text-gray-200"
                                >
                                    Category
                                </h2>
                                <div class="flex items-center">
                                    <div
                                        class="p-2 rounded-full bg-emerald-200"
                                    >
                                        <CategoryIcon
                                            class="w-8 h-8 fill-emerald-600"
                                        />
                                    </div>
                                    <div class="flex flex-col ml-2">
                                        <div class="text-xl font-semibold">
                                            0
                                        </div>
                                        <div
                                            class="text-sm font-bold text-emerald-600"
                                        >
                                            Total Category
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-4 sm:col-span-1">
                        <div
                            class="overflow-hidden bg-white shadow-sm sm:rounded-xl dark:bg-gray-800"
                        >
                            <div
                                class="p-6 bg-white border-b border-gray-200 dark:text-gray-200 dark:bg-gray-800 dark:border-b-0"
                            >
                                <h2
                                    class="mb-3 text-xl font-semibold leading-tight tracking-wider text-gray-800 dark:text-gray-200"
                                >
                                    Users
                                </h2>
                                <div class="flex items-center">
                                    <div class="p-2 rounded-full bg-amber-200">
                                        <UsersIcon
                                            class="w-8 h-8 text-amber-600"
                                        />
                                    </div>
                                    <div class="flex flex-col ml-2">
                                        <div class="text-xl font-semibold">
                                            0
                                        </div>
                                        <div
                                            class="text-sm font-bold text-amber-600"
                                        >
                                            Total Users
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-4 sm:col-span-1">
                        <div
                            class="overflow-hidden bg-white shadow-sm sm:rounded-xl dark:bg-gray-800"
                        >
                            <div
                                class="p-6 bg-white border-b border-gray-200 dark:text-gray-200 dark:bg-gray-800 dark:border-b-0"
                            >
                                <h2
                                    class="mb-3 text-xl font-semibold leading-tight tracking-wider text-gray-800 dark:text-gray-200"
                                >
                                    Roles
                                </h2>
                                <div class="flex items-center">
                                    <div class="p-2 rounded-full bg-rose-200">
                                        <RolesIcon
                                            class="w-8 h-8 fill-rose-600"
                                        />
                                    </div>
                                    <div class="flex flex-col ml-2">
                                        <div class="text-xl font-semibold">
                                            0
                                        </div>
                                        <div
                                            class="text-sm font-bold text-rose-600"
                                        >
                                            Total Roles
                                        </div>
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
