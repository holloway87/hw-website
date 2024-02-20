<template>
    <div class="sm:flex sm:max-w-2xl sm:mx-auto mb-5">
        <div class="sm:flex-none">
            <div class="bg-[#151f1d] text-white text-sm inline-block sm:text-right p-3 rounded-md sm:w-[7.5rem]">
                <div class="flex items-center">
                    <div class="flex-none">
                        <b-icon-calendar class="inline-block text-3xl mr-2" />
                    </div>
                    <p class="grow">
                        <span class="sm:block">{{ date }}</span>
                        {{ time }}
                    </p>
                </div>
            </div>
        </div>
        <div class="sm:flex-none">
            <div class="w-6 h-5 border-r-2 sm:w-5 sm:mt-6 sm:border-t-2 sm:border-r-0 border-dashed border-[#151f1d]"
            ></div>
        </div>
        <div class="sm:grow">
            <div class="bg-[#151f1d] p-3 rounded-md">
                <h3 v-if="title" class="text-white text-2xl mb-3">{{ title }}</h3>
                <div v-if="$slots.default" class="text-white mb-3">
                    <slot />
                </div>

                <PhotosGallery v-if="images.length" :files="images" :class="{
                    'gallery-columns-2': 2 <= images.length
                }" />
            </div>
        </div>
    </div>
</template>

<script>
import { BIconCalendar } from 'bootstrap-vue';
import PhotosGallery from './photos-gallery';

export default {
    components: { BIconCalendar, PhotosGallery },
    props: {
        'date': {
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
    },
};
</script>
