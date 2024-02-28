<template>
    <div class="app">
        <div class="sticky top-0 left-0 right-0 bg-[#151f1d] border-b border-black shadow-md shadow-gray-900/65 h-9 z-20 mb-5">
            <div class="container mx-auto lg:max-w-[1140px]">
                <div class="flex flex-row items-center">
                    <router-link to="/" class="inline-block text-white text-xl leading-9 ml-4">hw-web</router-link>

                    <div v-if="store.back_url" class="grow text-right">
                        <router-link
                            class="inline-block h-9 bg-teal-600 border-b border-black text-white text-md text-center leading-7 pl-1.5 pr-4 sm:pr-2.5 sm:mr-4 py-1 align-middle"
                            :to="store.back_url"
                        >
                            <ChevronLeftIcon class="h-5 inline-block align-text-bottom" />
                            back
                        </router-link>
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
import useDefaultStore from './store';
import { ChevronLeftIcon } from '@heroicons/vue/24/outline';

const store = useDefaultStore();
</script>
