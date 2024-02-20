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
                        ><b-icon-chevron-left /></ButtonText>
                    </p>
                </div>
                <div>
                    <p v-if="current_image < image_files.length -1" class="text-center">
                        <ButtonText
                            v-on:click="eventNextImage"
                        ><b-icon-chevron-right /></ButtonText>
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { AjaxRequest } from '../lib/ajax-request';
import { BIconChevronLeft, BIconChevronRight } from 'bootstrap-vue';
import ButtonText from './button-text';

export default {
    components: { BIconChevronLeft, BIconChevronRight, ButtonText },
    data() {
        return {
            'current_image': null,
            'image_files': null,
        };
    },
    methods: {
        eventNextImage() {
            this.current_image++;
        },
        eventPreviousImage() {
            this.current_image--;
        },
    },
    mounted() {
        let request = new AjaxRequest('GET', this.images_data_url);
        request.send((data) => {
            let response = JSON.parse(data.responseText);
            if ('object' !== typeof response) {
                return;
            }

            this.image_files = response.files;
            this.current_image = 0;
        });
    },
    props: {
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
    },
};
</script>
