<template>
    <div class="images-pager mb-5">
        <p v-if="null === image_files">Loading...</p>
        <p v-if="null !== image_files && !image_files.length">{{ no_images_message }}</p>

        <div v-if="null !== image_files && image_files.length">
            <div class="grid grid-cols-2">
                <div class="col-span-2 md:max-w-[75%] mx-auto">
                    <img :src="image_files[current_image]" class="mx-auto mb-4" :alt="title">
                </div>
                <div>
                    <p v-if="0 < current_image" class="text-center">
                        <ButtonText
                            v-on:click="eventPreviousImage"
                        ><ChevronLeftIcon class="w-6 h-6" /></ButtonText>
                    </p>
                </div>
                <div>
                    <p v-if="current_image < image_files.length -1" class="text-center">
                        <ButtonText
                            v-on:click="eventNextImage"
                        ><ChevronRightIcon class="w-6 h-6" /></ButtonText>
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { onMounted, ref } from 'vue';
import { AjaxRequest } from '../lib/ajax-request';
import { ChevronLeftIcon, ChevronRightIcon } from '@heroicons/vue/24/outline';
import ButtonText from './button-text';

const current_image = ref(0);
const image_files = ref(null);
const props = defineProps({
    'images_data_url': {
        'required': true,
        'type': String,
    },
    'no_images_message': {
        'required': true,
        'type': String,
    },
    'title': {
        'required': true,
        'type': String,
    },
});

onMounted(() => {
    (new AjaxRequest('GET', props.images_data_url))
        .done((data) => {
            let response = JSON.parse(data.responseText);
            if ('object' !== typeof response) {
                return;
            }

            image_files.value = response.files;
            current_image.value = 0;
        })
        .send();
});

function eventNextImage() {
    current_image.value++;
}
function eventPreviousImage() {
    current_image.value--;
}
</script>
