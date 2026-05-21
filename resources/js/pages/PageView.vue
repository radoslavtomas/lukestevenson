<script setup lang="ts">
import { Head, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import MainLayout from '../layouts/MainLayout.vue';

const page = computed(() => usePage<PageProps>().props.page);

interface Page {
    title: string;
    name: string;
    body: string;
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
        <section class="content mx-auto max-w-3xl" v-html="page.body"></section>
    </main-layout>
</template>

<style scoped></style>
