<template>
    <div>
        <p v-if="null === image_files">Loading...</p>
        <p v-if="null !== image_files && !image_files.length">{{ no_images_message }}</p>

        <div v-if="null !== image_files && image_files.length">
            <b-row>
                <b-col sm="8" offset-sm="2">
                    <img :src="image_files[current_image]" class="img-fluid mx-auto mb-4 d-block" :alt="title">
                </b-col>
                <b-col cols="6">
                    <p class="text-center">
                        <b-button
                            variant="primary"
                            v-if="0 < current_image"
                            v-on:click="eventPreviousImage"
                        ><b-icon-chevron-left /></b-button>
                    </p>
                </b-col>
                <b-col cols="6">
                    <p class="text-center">
                        <b-button
                            variant="primary"
                            v-if="current_image < image_files.length -1"
                            v-on:click="eventNextImage"
                        ><b-icon-chevron-right /></b-button>
                    </p>
                </b-col>
            </b-row>
        </div>
    </div>
</template>

<script>
import { BIconChevronLeft, BIconChevronRight } from 'bootstrap-vue';

import { AjaxRequest } from '../lib/ajax-request';

export default {
    components: { BIconChevronLeft, BIconChevronRight },
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
