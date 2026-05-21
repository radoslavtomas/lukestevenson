<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({
    mobile: {
        default: false,
    },
});

const mobileClasses = computed(() => {
    if (props.mobile) {
        return 'text-left ml-3 py-1';
    } else {
        return 'text-center text-sm py-3 uppercase';
    }
});
</script>

<template>
    <Link
        class="block w-full px-4 leading-5 font-bold transition duration-150 ease-in-out focus:outline-none"
        :class="mobileClasses"
    >
        <span
            class="border-b-2 border-transparent text-gray-700 transition duration-50 ease-in-out hover:border-red-600"
        >
            <slot />
        </span>
    </Link>
</template>

<style scoped></style>
