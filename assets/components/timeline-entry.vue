<template>
    <div class="sm:flex sm:max-w-2xl sm:mx-auto mb-5">
        <div class="sm:flex-none">
            <router-link
                :to="entry_link"
                class="bg-widget text-text text-sm inline-block sm:text-right p-3 rounded-md shadow-md sm:w-[7.5rem]"
            >
                <div class="flex items-center">
                    <div class="flex-none">
                        <CalendarIcon class="w-9 h-9 mr-2" />
                    </div>
                    <p class="grow">
                        <span class="sm:block">{{ date }}</span>
                        {{ time }}
                    </p>
                </div>
            </router-link>
        </div>
        <div class="sm:flex-none">
            <div class="w-6 h-5 border-r-2 sm:w-5 sm:mt-6 sm:border-t-2 sm:border-r-0 border-dashed border-widget"
            ></div>
        </div>
        <div class="sm:grow">
            <div class="bg-widget p-3 rounded-md shadow-md">
                <h3 v-if="title" class="text-text text-2xl mb-3">{{ title }}</h3>
                <div v-if="$slots.default" class="text-text mb-3">
                    <slot />
                </div>

                <PhotosGallery v-if="images.length" :files="images" :class="{
                    'gallery-columns-2': 2 <= images.length
                }" />
            </div>
        </div>
    </div>
</template>

<script setup>
import { computed } from 'vue';
import { CalendarIcon } from '@heroicons/vue/24/outline';
import PhotosGallery from './photos-gallery';

const props = defineProps({
    'date': {
        'required': true,
        'type': String,
    },
    'id': {
        'required': true,
        'type': String,
    },
    'images': {
        'required': false,
        'type': Array,
    },
    'time': {
        'required': true,
        'type': String,
    },
    'title': {
        'required': false,
        'type': String,
    },
});

const entry_link = computed(() => '/timeline/' + props.id);
</script>
