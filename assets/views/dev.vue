<template>
    <div>
        <h1>Programming</h1>

        <p>These are some of my programming projects.</p>

        <b-row>
            <b-col sm="6" md="4">
                <b-card class="mb-4" title="My website">
                    <b-card-text>The code to this website can be found on my github.</b-card-text>

                    <b-button
                        href="https://github.com/holloway87/hw-website"
                        rel="nofollow"
                        target="_blank"
                        variant="primary"
                    ><b-icon-github /> GitHub source</b-button>
                </b-card>
            </b-col>
        </b-row>
    </div>
</template>

<script>
import { BIconGithub } from 'bootstrap-vue';

export default {
    components: { BIconGithub },
};
</script>
