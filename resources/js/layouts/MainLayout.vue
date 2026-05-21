<script setup lang="ts">
import { Head, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import NavigationBar from '../components/NavigationBar.vue';

const settings = computed(() => usePage<PageProps>().props.value.settings);

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
</script>

<template>
    <Head>
        <meta name="description" :content="settings.page_description" />
        <meta name="keywords" :content="settings.page_keywords" />
    </Head>
    <header>
        <navigation-bar />
    </header>

    <main class="custom-container relative mx-auto min-h-screen">
        <slot />
    </main>

    <footer class="footer-shadow mt-8 bg-gray-700 text-white">
        <div
            class="custom-container flex flex-col items-center justify-between py-12 sm:flex-row"
        >
            <section class="mb-8 text-center sm:mb-0 sm:text-left">
                <p class="">{{ settings.page_title }}</p>
                <p class="text-xs">{{ settings.page_subtitle }}</p>
            </section>

            <section
                class="mb-8 flex h-full flex-col gap-1 sm:mb-0 sm:flex-row"
            >
                <img
                    src="/assets/img/bacp_logo_accr.png"
                    alt="bacp logo"
                    class="h-auto w-44 sm:h-16 sm:w-auto"
                />
            </section>

            <section class="text-center text-sm sm:text-right">
                <p class="">{{ settings.address_line1 }}</p>
                <p class="">{{ settings.address_line2 }}</p>
                <p class="">{{ settings.address_line3 }}</p>
                <p class="">{{ settings.postocde }}</p>
            </section>
        </div>
    </footer>
</template>

<style scoped>
.footer-shadow {
    box-shadow:
        0 -15px 25px -5px rgb(0 0 0 / 0.1),
        0 -8px 10px -6px rgb(0 0 0 / 0.1);
}
</style>
