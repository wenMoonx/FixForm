<script setup>
import { computed, ref, onMounted } from "vue";
import { Link, usePage } from "@inertiajs/vue3";
import { useColorMode, useCycleList } from "@vueuse/core";
import ApplicationLogo from "@/Components/Icons/ApplicationLogo.vue";
import DesktopIcon from "@/Components/Icons/DesktopIcon.vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import MoonIcon from "@/Components/Icons/MoonIcon.vue";
import Sidebar from "./Partials/Sidebar.vue";
import SunIcon from "@/Components/Icons/SunIcon.vue";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
import ThemeMode from "@/Components/ThemeMode.vue";
import LogoutIcon from "@/Components/Icons/LogoutIcon.vue";
import ProfileIcon from "@/Components/Icons/ProfileIcon.vue";
import ArrowToggleIcon from "@/Components/Icons/ArrowToggleIcon.vue";
import ArrowDownIcon from "@/Components/Icons/ArrowDownIcon.vue";
import TagIcon from "@/Components/Icons/TagIcon.vue";
import { useCartStore } from "@/Store/cart";

const showingNavigationDropdown = ref(false);

const user = computed(() => usePage().props.auth.user);
const cartStore = useCartStore();

const mode = useColorMode({
    emitAuto: true,
});

const { next } = useCycleList(["dark", "light", "auto"], {
    initialValue: mode,
});

const sidebar = ref(true);

onMounted(() => {
    if (window.innerWidth < 992) {
        sidebar.value = false;
    }
});
</script>

<template>
    <div>
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            <nav
                class="bg-white border-b border-gray-100 sm:fixed sm:w-full sm:z-10 dark:bg-gray-800 dark:border-gray-700"
            >
                <!-- Primary Navigation Menu -->
                <div class="px-4 mx-auto sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Logo -->
                            <div
                                class="flex items-center sm:justify-between sm:min-w-[240px]"
                            >
                                <div class="flex items-center gap-4 font-viga">
                                    <Link :href="route('dashboard')">
                                        <ApplicationLogo
                                            class="block w-auto h-9"
                                        />
                                    </Link>
                                    <div
                                        class="text-xl font-semibold text-indigo-500 capitalize dark:text-gray-100 sm:text-2xl"
                                    >
                                        FixForm
                                    </div>
                                </div>

                                <!-- Sidebar Button -->
                                <button
                                    class="hidden p-1 transition duration-200 ease-in rounded-lg focus:ring-indigo-500 focus:ring-offset-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 sm:block"
                                    @click="sidebar = !sidebar"
                                >
                                    <ArrowToggleIcon :sidebar="sidebar" />
                                </button>
                            </div>
                        </div>

                        <!-- Theme Mode -->
                        <div class="hidden sm:flex sm:items-center sm:ml-6">
                            <button
                                class="p-2 transition duration-200 ease-in rounded-lg focus:ring-indigo-500 focus:ring-offset-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2"
                                @click="next()"
                            >
                                <div
                                    class="items-center block font-medium text-gray-600 hover:text-indigo-600 dark:text-gray-400 dark:hover:text-gray-500"
                                >
                                    <MoonIcon
                                        v-if="mode === 'dark'"
                                        size="h-5 w-5"
                                    />
                                    <SunIcon
                                        v-if="mode === 'light'"
                                        size="h-5 w-5"
                                        fill="fill-indigo-500"
                                    />
                                    <DesktopIcon
                                        v-if="mode === 'auto'"
                                        size="h-5 w-5"
                                    />
                                </div>
                            </button>

                            <!-- Cart -->

                            <Link
                                :href="route('cart.index')"
                                class="relative h=[50px] p-2 rounded-sm cursor-pointer"
                            >
                                <div class="relative ml-2">
                                    <TagIcon color="orange" />
                                    <span
                                        class="absolute -top-2 left-3 inline-flex items-center justify-center h-5 w-5 rounded-full bg-red-500 text-white"
                                    >
                                        {{ cartStore?.cart.length }}
                                    </span>
                                </div>
                            </Link>

                            <!-- Settings Dropdown -->
                            <div class="relative ml-3">
                                <Dropdown align="right" width="48">
                                    <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button
                                                type="button"
                                                class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out bg-white border border-transparent rounded-md dark:text-gray-200 dark:bg-gray-800 hover:text-gray-700 focus:outline-none"
                                            >
                                                {{ user.name }}

                                                <ArrowDownIcon />
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <div
                                            class="block w-full px-4 py-2 text-xs leading-5 text-left transition duration-150 ease-in-out border-b select-none to-gray-700 dark:text-gray-200"
                                        >
                                            Signed in as {{ user.email }}
                                        </div>
                                        <DropdownLink
                                            :href="route('profile.edit')"
                                            class="flex items-center gap-4"
                                        >
                                            <ProfileIcon />
                                            Profile
                                        </DropdownLink>
                                        <DropdownLink
                                            :href="route('logout')"
                                            method="post"
                                            as="button"
                                            class="flex items-center gap-4"
                                        >
                                            <LogoutIcon />
                                            Log Out
                                        </DropdownLink>
                                    </template>
                                </Dropdown>
                            </div>
                        </div>

                        <!-- Hamburger -->
                        <div class="flex items-center -mr-2 sm:hidden">
                            <button
                                class="inline-flex items-center justify-center p-2 text-gray-400 transition duration-150 ease-in-out rounded-md hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 dark:hover:bg-gray-900"
                                @click="
                                    showingNavigationDropdown =
                                        !showingNavigationDropdown
                                "
                            >
                                <svg
                                    class="w-6 h-6"
                                    stroke="currentColor"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        :class="{
                                            hidden: showingNavigationDropdown,
                                            'inline-flex':
                                                !showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16"
                                    />
                                    <path
                                        :class="{
                                            hidden: !showingNavigationDropdown,
                                            'inline-flex':
                                                showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"
                                    />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div
                    :class="{
                        block: showingNavigationDropdown,
                        hidden: !showingNavigationDropdown,
                    }"
                    class="sm:hidden"
                >
                    <div class="pt-2 pb-3 space-y-1">
                        <ResponsiveNavLink
                            :href="route('dashboard')"
                            :active="route().current('dashboard')"
                        >
                            Dashboard
                        </ResponsiveNavLink>
                        <ResponsiveNavLink
                            :href="route('dashboard.posts.index')"
                            :active="route().current('dashboard.posts.*')"
                        >
                            Manage Products
                        </ResponsiveNavLink>
                        <ResponsiveNavLink
                            :href="route('dashboard.products.index')"
                            :active="route().current('dashboard.products.*')"
                        >
                            Products
                        </ResponsiveNavLink>
                        <ResponsiveNavLink
                            :href="route('order.index')"
                            :active="route().current('order.index.*')"
                        >
                            My Orders
                        </ResponsiveNavLink>
                        <ResponsiveNavLink
                            v-if="
                                user.role === 'super-admin' ||
                                user.role === 'admin'
                            "
                            :href="route('users.index')"
                            :active="route().current('users.*')"
                        >
                            User
                        </ResponsiveNavLink>
                        <ResponsiveNavLink
                            v-if="
                                user.role === 'super-admin' ||
                                user.role === 'admin'
                            "
                            :href="route('roles.index')"
                            :active="route().current('roles.*')"
                        >
                            Roles
                        </ResponsiveNavLink>
                        <ResponsiveNavLink
                            v-if="
                                user.role === 'super-admin' ||
                                user.role === 'admin'
                            "
                            :href="route('permissions.index')"
                            :active="route().current('permissions.*')"
                        >
                            Permissions
                        </ResponsiveNavLink>
                    </div>

                    <!-- Responsive Settings Options -->
                    <div class="pt-4 pb-1 border-t border-gray-200">
                        <div class="flex justify-between px-4">
                            <div>
                                <div
                                    class="text-base font-medium text-gray-500"
                                >
                                    {{ $page.props.auth.user.name }}
                                </div>
                                <div class="text-sm font-medium text-gray-500">
                                    {{ $page.props.auth.user.email }}
                                </div>
                            </div>

                            <!-- Switch Theme -->
                            <ThemeMode />
                        </div>

                        <div class="mt-3 space-y-1">
                            <ResponsiveNavLink
                                :href="route('profile.edit')"
                                :active="route().current('profile.edit')"
                            >
                                Profile
                            </ResponsiveNavLink>
                            <ResponsiveNavLink :href="route('home')">
                                Home
                            </ResponsiveNavLink>
                            <ResponsiveNavLink
                                :href="route('logout')"
                                method="post"
                                as="button"
                            >
                                Log Out
                            </ResponsiveNavLink>
                        </div>
                    </div>
                </div>
            </nav>

            <div class="w-full sm:flex">
                <!-- Sidebar -->
                <transition name="slide-fade">
                    <Sidebar v-show="sidebar" />
                </transition>

                <!-- Page Heading -->
                <div
                    class="w-full sm:mt-16"
                    :class="
                        sidebar
                            ? 'sm:ml-[280px] transition-all duration-300'
                            : 'transition-all duration-500'
                    "
                >
                    <header
                        v-if="$slots.header"
                        class="bg-white shadow dark:bg-gray-800"
                    >
                        <div
                            class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8"
                        >
                            <slot name="header" />
                        </div>
                    </header>

                    <!-- Page Content -->
                    <main>
                        <slot />
                    </main>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.slide-fade-enter-active {
    transition: all 0.3s ease-out;
}

.slide-fade-leave-active {
    transition: all 0.3s cubic-bezier(1, 0.5, 0.8, 1);
}

.slide-fade-enter-from,
.slide-fade-leave-to {
    transform: translateX(-20px);
    opacity: 0;
}
</style>
