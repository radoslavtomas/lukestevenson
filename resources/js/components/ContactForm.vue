<script setup lang="ts">
import { ArrowRightCircleIcon } from '@heroicons/vue/24/outline';
import useVuelidate from '@vuelidate/core';
import {
    required,
    email,
    numeric,
    minLength,
    maxLength,
    requiredIf,
} from '@vuelidate/validators';
import { computed, reactive, ref } from 'vue';

const contactForm = ref<HTMLFormElement | null>(null);
const form = reactive({
    name: '',
    contact_method: '',
    phone_times: '',
    email: '',
    phone: '',
    reason: '',
    therapy_needs: '',
    comment: '',
    spree: '',
});

const rules = computed(() => {
    return {
        name: { required, maxLength: maxLength(100) },
        contact_method: { required },
        phone_times: {
            requiredIf: requiredIf(form.contact_method === 'phone'),
            maxLength: maxLength(500),
        },
        email: { required, email },
        phone: { numeric, minLength: minLength(11), maxLength: maxLength(12) },
        reason: { required },
        therapy_needs: {
            requiredIf: requiredIf(form.reason === 'therapy'),
            maxLength: maxLength(500),
        },
        comment: { maxLength: maxLength(500) },
    };
});

const v$ = useVuelidate(rules, form);

const handleForm = async () => {
    if (form.spree) {
        return;
    }

    const result = await v$.value.$validate();

    if (!result) {
        const el = document.getElementsByClassName('focus:border-red-300')[0];
        setTimeout(() => {
            el.scrollIntoView({ behavior: 'smooth' });
        }, 100);

        return;
    }

    if (contactForm.value) {
        contactForm.value.submit();
    }
};
</script>

<template>
    <form
        ref="contactForm"
        method="POST"
        action="https://formspree.io/f/xbjbvwey"
        class="my-4"
        @submit.prevent="handleForm"
    >
        <label class="mb-4 block">
            <span class="text-gray-700">Name</span>
            <input
                type="text"
                name="name"
                required
                v-model="form.name"
                class="focus:ring-opacity-50 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200"
                :class="v$.name.$error ? 'border-red-400' : ''"
                placeholder=""
            />
            <span v-for="error of v$.name.$errors" :key="error.$uid">
                <span class="text-xs text-red-600">{{ error.$message }}</span>
            </span>
        </label>

        <label class="mb-4 block">
            <span class="text-gray-700"
                >Preferred way for Luke to make first contact</span
            >
            <select
                name="contact_method"
                required
                v-model="form.contact_method"
                class="focus:ring-opacity-50 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200"
                :class="v$.contact_method.$error ? 'border-red-400' : ''"
            >
                <option value="">- Please select -</option>
                <option value="email">Email</option>
                <option value="phone">Phone call</option>
                <option value="text">Text message</option>
            </select>
            <span v-for="error of v$.contact_method.$errors" :key="error.$uid">
                <span class="text-xs text-red-600">{{ error.$message }}</span>
            </span>
        </label>

        <label class="mb-4 block" v-if="form.contact_method === 'phone'">
            <span class="text-gray-700"
                >Please give a couple of days / times that would be convenient
                to call you back</span
            >
            <textarea
                name="phone_times"
                v-model="form.phone_times"
                class="focus:ring-opacity-50 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200"
                :class="v$.phone_times.$error ? 'border-red-400' : ''"
                rows="3"
            ></textarea>
            <span v-for="error of v$.phone_times.$errors" :key="error.$uid">
                <span class="text-xs text-red-600">{{ error.$message }}</span>
            </span>
        </label>

        <label class="mb-4 block">
            <span class="text-gray-700">Email</span>
            <input
                name="email"
                required
                type="email"
                v-model="form.email"
                class="focus:ring-opacity-50 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200"
                :class="v$.email.$error ? 'border-red-400' : ''"
                placeholder="john@example.com"
            />
            <span v-for="error of v$.email.$errors" :key="error.$uid">
                <span class="text-xs text-red-600">{{ error.$message }}</span>
            </span>
        </label>

        <label class="mb-4 block">
            <span class="text-gray-700">Contact number</span>
            <input
                name="phone"
                type="text"
                v-model="form.phone"
                class="focus:ring-opacity-50 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200"
                :class="v$.phone.$error ? 'border-red-400' : ''"
                placeholder=""
            />
            <span v-for="error of v$.phone.$errors" :key="error.$uid">
                <span class="text-xs text-red-600">{{ error.$message }}</span>
            </span>
        </label>

        <label class="mb-4 block">
            <span class="text-gray-700">Reason for message</span>
            <select
                name="reason"
                required
                v-model="form.reason"
                class="focus:ring-opacity-50 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200"
                :class="v$.reason.$error ? 'border-red-400' : ''"
            >
                <option value="">- Please select -</option>
                <option value="therapy">To request a therapy session</option>
                <option value="student">
                    Student looking for therapy training
                </option>
                <option value="work">To find out more about your work</option>
                <option value="general">General inquiry</option>
            </select>
            <span v-for="error of v$.reason.$errors" :key="error.$uid">
                <span class="text-xs text-red-600">{{ error.$message }}</span>
            </span>
        </label>

        <label class="mb-4 block" v-if="form.reason === 'therapy'">
            <span class="text-gray-700"
                >If you are requesting for therapy please give a light
                description of needs
            </span>
            <textarea
                name="therapy_needs"
                v-model="form.therapy_needs"
                class="focus:ring-opacity-50 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200"
                :class="v$.therapy_needs.$error ? 'border-red-400' : ''"
                rows="3"
            ></textarea>
            <span v-for="error of v$.therapy_needs.$errors" :key="error.$uid">
                <span class="text-xs text-red-600">{{ error.$message }}</span>
            </span>
        </label>
        <p class="mb-4 text-xs text-gray-400" v-if="form.reason === 'therapy'">
            This is just so I can have some understanding of your needs
            please do not share anything that you are not comfortable to
            share.
        </p>

        <label class="mb-4 block">
            <span class="text-gray-700">Comment or Message</span>
            <textarea
                name="comment"
                v-model="form.comment"
                class="focus:ring-opacity-50 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200"
                :class="v$.comment.$error ? 'border-red-400' : ''"
                rows="3"
            ></textarea>
            <span v-for="error of v$.comment.$errors" :key="error.$uid">
                <span class="text-xs text-red-600">{{ error.$message }}</span>
            </span>
        </label>

        <div v-show="false">
            <input type="text" name="spree" v-model="form.spree" />
        </div>

        <button
            type="submit"
            class="mb-3 w-full rounded bg-green-400 px-4 py-3 text-center text-white shadow-md hover:bg-green-500 sm:mb-0 sm:w-auto"
        >
            Submit <ArrowRightCircleIcon class="inline h-5 w-5" />
        </button>
    </form>
</template>

<style scoped></style>
