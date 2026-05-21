<script setup lang="ts">
import { UserIcon, PuzzlePieceIcon } from '@heroicons/vue/24/outline';
import { Head, Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import MainLayout from '../layouts/MainLayout.vue';
import ContactForm from '../components/ContactForm.vue';

const page = computed(() => usePage<PageProps>().props.value.page);
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
    <main-layout>
        <Head :title="page.title" />
        <section
            class="home-hero relative mb-4 flex h-56 flex-col items-center justify-center bg-gray-100 text-white"
        >
            <div
                class="absolute top-0 left-0 h-full w-full bg-gray-700 opacity-40"
            ></div>
            <h1 class="z-20 mb-2 text-3xl font-bold uppercase">
                {{ settings.page_title }}
            </h1>
            <h4 class="z-20 text-sm">{{ settings.page_subtitle }}</h4>
        </section>

        <section
            class="mx-auto my-6 max-w-4xl sm:my-10"
            v-html="page.body"
        ></section>

        <section
            class="mb-4 flex flex-col items-center justify-center py-3 sm:flex-row"
        >
            <Link
                href="/about-me"
                class="mr-0 mb-4 flex w-full items-center justify-center rounded bg-cyan-500 px-4 py-3 text-center text-white shadow-md hover:bg-cyan-600 sm:mr-3 sm:mb-0 sm:w-auto"
            >
                About me <UserIcon class="ml-1 h-4 w-4" />
            </Link>
            <Link
                href="/practice/my-approach"
                class="flex w-full items-center justify-center rounded bg-purple-500 px-4 py-3 text-center text-white shadow-md hover:bg-purple-600 sm:w-auto"
            >
                My approach <PuzzlePieceIcon class="ml-1 h-4 w-4" />
            </Link>
        </section>

        <section class="mx-auto max-w-2xl">
            <h1 class="mt-10 mb-4 text-center text-2xl font-bold uppercase">
                Any enquiries?
            </h1>
            <ContactForm />
        </section>
    </main-layout>
</template>

<style scoped></style>
