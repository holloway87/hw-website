<template>
    <div class="page-home">
        <b-row>
            <b-col sm="4">
                <router-link to="/art">
                    <b-card
                        class="mb-4"
                        img-src="/images/home_art.png"
                        overlay
                        title="Art"
                    >
                        <b-card-text>Have a look at my illustrations.</b-card-text>
                    </b-card>
                </router-link>
            </b-col>
            <b-col sm="4">
                <router-link to="/photos">
                    <b-card
                        class="mb-4"
                        img-src="/images/home_photos.png"
                        overlay
                        title="Photos"
                    >
                        <b-card-text>I sometimes like to take photos.</b-card-text>
                    </b-card>
                </router-link>
            </b-col>
            <b-col sm="4">
                <router-link to="/dev">
                    <b-card
                        class="mb-4"
                        img-src="/images/home_dev.png"
                        overlay
                        title="Programming"
                    >
                        <b-card-text>These are some of my programming projects.</b-card-text>
                    </b-card>
                </router-link>
            </b-col>
        </b-row>
    </div>
</template>

<script>
export default {};
</script>

<style lang="scss">
@import "node_modules/bootstrap/scss/functions";
@import "../styles/bootstrap/variables";

.page-home {
    a {
        .card {
            border: none;

            .card-body {
                color: $white;
            }
        }

        &:hover {
            text-decoration: none;
        }
    }
}
</style>
