<script setup lang="ts">
import { PhoneIcon } from '@heroicons/vue/24/outline';
import { Head, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import MainLayout from '../layouts/MainLayout.vue';

const settings = computed(() => usePage<PageProps>().props.settings);

interface Settings {
    page_title: string;
    page_subtitle: string;
    page_description: string;
    page_keywords: string;
    address_line1: string;
    address_line2: string;
    address_line3: string;
    postcode: string;
    phone: string;
    email: string;
    map: string;
}

interface PageProps extends Record<string, any> {
    settings: Settings;
}
</script>

<template>
    <main-layout>
        <Head title="Where am I" />
        <section class="my-8">
            <h1 class="text-center text-2xl font-bold uppercase">Where am I</h1>
        </section>
        <section class="mb-12 flex flex-col items-center justify-center">
            <p class="mb-1">{{ settings.address_line1 }}</p>
            <p class="mb-1">{{ settings.address_line2 }}</p>
            <p class="mb-1">{{ settings.address_line3 }}</p>
            <p class="mb-1">{{ settings.postcode }}</p>
            <br />
            <a
                :href="`tel:${settings.phone}`"
                class="mr-0 mb-4 flex w-full items-center justify-center rounded bg-green-500 px-4 py-3 text-center text-white shadow-md hover:bg-green-600 sm:mr-3 sm:mb-0 sm:w-auto"
            >
                {{ settings.phone }} <PhoneIcon class="flip ml-1 h-5 w-5" />
            </a>
        </section>

        <section>
            <div class="iframe w-full" v-html="settings.map"></div>
        </section>
    </main-layout>
</template>

<style scoped>
.iframe iframe {
    width: 100% !important;
}

.flip {
    transform: scaleX(-1);
}
</style>
