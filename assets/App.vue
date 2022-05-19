<template>
    <div>
        <router-view />
        <div class="text-center">
            <a rel="me" href="https://mastodon.art/@holloway" target="_blank"><b-icon-mastodon /></a> &middot;
            <a rel="nofollow" href="https://www.instagram.com/me_hw/" target="_blank"><b-icon-instagram /></a> &middot;
            <a rel="nofollow" href="https://twitter.com/me_hw" target="_blank"><b-icon-twitter /></a>
        </div>
    </div>
</template>

<script>
import { BIconInstagram, BIconMastodon, BIconTwitter } from 'bootstrap-vue';

export default {
    components: { BIconInstagram, BIconMastodon, BIconTwitter },
    data() {
        return {};
    },
};
</script>
