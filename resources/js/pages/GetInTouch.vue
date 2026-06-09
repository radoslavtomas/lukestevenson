<script setup lang="ts">
import { Head, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import ContactForm from '../components/ContactForm.vue';
import MainLayout from '../layouts/MainLayout.vue';

const page = computed(() => usePage<PageProps>().props.page);

interface Page {
    title: string;
    name: string;
}

interface PageProps extends Record<string, any> {
    page: Page;
}
</script>

<template>
    <main-layout>
        <Head :title="page.title" />
        <section class="my-8">
            <h1 class="text-center text-2xl font-bold uppercase">
                {{ page.name }}
            </h1>
        </section>
        <section class="mx-auto max-w-xl">
            <ContactForm />
        </section>
    </main-layout>
</template>

<style scoped></style>
