<template>
    <div>
        <p v-if="null === files">Loading...</p>
        <p v-if="null !== files && !files.length">There was an error loading the photos.</p>
        <VuePictureSwipe
            v-if="null !== files && files.length"
            :items="files"
            :options="{'shareEl': false}"
        ></VuePictureSwipe>
    </div>
</template>

<script>
import VuePictureSwipe from 'vue-picture-swipe';

import { AjaxRequest } from '../lib/ajax-request';

export default {
    components: { VuePictureSwipe },
    data() {
        return {
            'files': null,
        };
    },
    mounted() {
        let data = new FormData();
        data.append('project', this.project);

        let request = new AjaxRequest('POST', '/photos/get-files', data);
        request.send((data) => {
            let response = JSON.parse(data.responseText);
            if ('object' !== typeof response || !response.success) {
                return;
            }

            this.files = response.files;
        });
    },
    props: {
        'project': {
            'required': true,
            'type': String,
        },
    },
};
</script>

<style lang="scss">
.my-gallery {
    display: flex;
    flex-wrap: wrap;
    margin-right: -1rem;
    margin-left: -1rem;

    figure.gallery-thumbnail {
        flex: 0 0 50%;
        max-width: 50%;
        position: relative;
        display: block !important;
        margin: 0 0 2rem !important;
        padding-right: 1rem;
        padding-left: 1rem;
        width: 100%;

        img {
            border-radius: 0.25rem;
            max-width: 100%;
            height: auto;
        }
    }
}

@media screen and (min-width: 768px) {
    .my-gallery {
        figure.gallery-thumbnail {
            flex: 0 0 33.333333%;
            max-width: 33.333333%;
        }
    }
}
</style>
