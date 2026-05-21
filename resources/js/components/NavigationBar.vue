<script setup lang="ts">
import { Bars3Icon, XMarkIcon } from '@heroicons/vue/24/outline';
import { Link, usePage } from '@inertiajs/vue3';
import { computed, onMounted, ref } from 'vue';

import MenuDropdown from '../components/MenuDropdown.vue';
import MenuDropdownLink from '../components/MenuDropdownLink.vue';

interface MenuItem {
    id: number;
    name: string;
    route: string;
    categories: Category[];
}

interface Category {
    name: string;
    url: string;
}

interface Settings {
    page_title: string;
    page_subtitle: string;
}

interface PageProps extends Record<string, any> {
    navigation: MenuItem[];
    settings: Settings;
}

declare function route(name: string, params?: Record<string, any>): string;

const openNav = ref(false);
const pathname = ref('');
const navigation = computed(() => usePage<PageProps>().props.navigation);
const settings = computed(() => usePage<PageProps>().props.settings);

onMounted(() => {
    // console.log(navigation.value)
    // console.log(window.location.pathname.substring(1))
    pathname.value = window.location.pathname.substring(1)
        ? window.location.pathname.substring(1)
        : '/';
});
</script>

<template>
    <nav class="relative tracking-widest">
        <div class="custom-container flex h-16 items-center justify-between">
            <!-- Mobile menu button -->
            <div class="flex items-center lg:hidden">
                <button
                    type="button"
                    class="inline-flex items-center justify-center rounded-md p-2 text-gray-800 hover:bg-gray-200 hover:text-gray-900 focus:ring-2 focus:ring-red-500 focus:outline-none focus:ring-inset"
                    aria-controls="mobile-menu"
                    aria-expanded="false"
                >
                    <span class="sr-only">Open main menu</span>
                    <Bars3Icon
                        v-if="!openNav"
                        @click="openNav = true"
                        class="h-6 w-6"
                    />
                    <XMarkIcon
                        v-else
                        @click="openNav = false"
                        class="h-6 w-6"
                    />
                </button>
            </div>

            <div class="flex items-center justify-end">
                <Link
                    :href="route('home')"
                    class="flex h-10 items-center justify-end sm:justify-start"
                >
                    <img
                        class="logo order-2 mt-1 hidden h-full w-auto lg:order-1"
                        src="/assets/img/logo.png"
                        alt="Logo"
                    />
                    <div
                        class="order-1 mr-2 text-right sm:text-left lg:order-2 lg:mr-0 lg:ml-2"
                    >
                        <h3 class="text-xl font-bold">
                            {{ settings.page_title }}
                        </h3>
                        <h6 class="text-xs leading-tight">
                            {{ settings.page_subtitle }}
                        </h6>
                    </div>
                </Link>
            </div>

            <!-- Desktop navigation menu -->
            <div class="hidden lg:ml-6 lg:block">
                <div
                    class="flex h-full items-center justify-between space-x-2 tracking-tight"
                >
                    <template v-for="menuItem in navigation" :key="menuItem.id">
                        <Link
                            v-if="!menuItem.categories.length"
                            :href="
                                menuItem.route === '/'
                                    ? menuItem.route
                                    : '/' + menuItem.route
                            "
                            :class="
                                pathname === menuItem.route
                                    ? 'border-red-600'
                                    : 'border-transparent'
                            "
                            class="inline-block border-b-2 px-2 py-1 text-sm font-bold text-gray-700 uppercase transition duration-50 ease-in-out hover:border-red-600 hover:text-gray-800"
                            aria-current="page"
                            >{{ menuItem.name }}</Link
                        >

                        <MenuDropdown v-else align="center" width="52">
                            <template #trigger>
                                <button
                                    :class="
                                        pathname === menuItem.route
                                            ? 'border-red-600'
                                            : 'border-transparent'
                                    "
                                    class="inline-block border-b-2 px-2 py-1 text-sm font-bold text-gray-700 uppercase hover:border-red-600 hover:text-gray-800"
                                >
                                    {{ menuItem['name'] }}
                                </button>
                            </template>
                            <template #content>
                                <MenuDropdownLink
                                    v-for="item in menuItem.categories"
                                    :key="item.url"
                                    :href="
                                        route(menuItem.route) + '/' + item.url
                                    "
                                    as="button"
                                >
                                    {{ item['name'] }}
                                </MenuDropdownLink>
                            </template>
                        </MenuDropdown>
                    </template>
                </div>
            </div>
        </div>

        <!-- Mobile menu -->
        <div
            v-if="openNav"
            class="absolute z-10 h-full w-full lg:hidden"
            id="mobile-menu"
        >
            <div
                class="relative z-50 space-y-1 border-y border-purple-300 bg-gray-100 px-2 pt-2 pb-3 opacity-95 shadow-xl"
            >
                <template v-for="menuItem in navigation" :key="menuItem.id">
                    <Link
                        v-if="!menuItem.categories.length"
                        :href="
                            menuItem.route === '/'
                                ? menuItem.route
                                : '/' + menuItem.route
                        "
                        :class="
                            pathname === menuItem.route
                                ? 'text-red-700'
                                : 'text-gray-800'
                        "
                        class="block px-3 py-2 text-sm font-bold uppercase hover:bg-gray-200 hover:text-gray-900"
                        aria-current="page"
                        >{{ menuItem.name }}</Link
                    >

                    <div
                        v-else
                        class="px-3 py-2 text-sm font-bold text-gray-500 uppercase hover:bg-gray-200"
                        aria-current="page"
                    >
                        {{ menuItem.name }}
                    </div>

                    <template v-if="menuItem.categories.length">
                        <MenuDropdownLink
                            v-for="item in menuItem.categories"
                            :key="item.url"
                            :href="route(menuItem.route) + '/' + item.url"
                            as="button"
                            :mobile="true"
                        >
                            {{ item['name'] }}
                        </MenuDropdownLink>
                    </template>
                </template>
            </div>

            <div
                v-show="openNav"
                class="fixed inset-0 top-20 z-20 backdrop-blur-sm"
                @click="openNav = false"
            ></div>
        </div>
    </nav>
</template>

<style scoped></style>
