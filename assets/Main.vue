<template>
    <div class="app">
        <div class="sticky top-0 left-0 right-0 bg-[#151f1d] border-b border-black shadow-md shadow-gray-900/65 h-9 z-20 mb-5">
            <div class="container mx-auto lg:max-w-[1140px]">
                <div class="flex flex-row items-center">
                    <router-link to="/" class="inline-block text-white text-xl leading-9 ml-4">hw-web</router-link>

                    <div v-if="store.back_url || store.logged_in" class="grow">
                        <ul class="flex flex-row gap-3 items-center justify-end">
                            <li v-if="store.logged_in">
                                <a
                                    href=""
                                    :class="{
                                        'text-teal-400': true,
                                        'hover:text-teal-500': true,
                                        'mr-4': !store.back_url
                                    }"
                                    v-on:click="logout"
                                >
                                    Logout
                                </a>
                            </li>
                            <li v-if="store.back_url">
                                <router-link
                                    class="inline-block h-9 bg-teal-600 border-b border-black text-white text-md text-center leading-7 pl-1.5 pr-4 sm:pr-2.5 sm:mr-4 py-1 align-middle"
                                    :to="store.back_url"
                                >
                                    <ChevronLeftIcon class="h-5 inline-block align-text-bottom" />
                                    back
                                </router-link>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="container mx-auto px-4 lg:max-w-[1140px]">
            <router-view />
        </div>
    </div>
</template>

<script setup>
import useDefaultStore from './stores/default';
import { useRouter } from 'vue-router';
import { ChevronLeftIcon } from '@heroicons/vue/24/outline';
import {AjaxRequest} from "./lib/ajax-request";

const store = useDefaultStore();
const router = useRouter();

function logout(event) {
    event.preventDefault();
    store.setLoggedIn(false);
    (new AjaxRequest('GET', '/admin-logout'))
        .done(() => {
            router.push('/');
        })
        .send();
}
</script>
