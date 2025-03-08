<template>
    <div class="page-art-maaya-community-doodles">
        <PageHeader title="Maaya's community doodles">
            I made some stupid doodles around Maaya's community.  Go check out her amazing art streams at
            <a href="https://www.twitch.tv/maaya" class="text-teal-400 hover:text-teal-600 hover:underline" target="_blank" ref="nofollow">Twitch</a>.
        </PageHeader>

        <ImagesPager
            images_data_url="/illustrations/maaya-community-doodles/get-image-files"
            no_images_message="There are currently no doodles."
            title="Maaya's community doodles"
        />

        <div class="text-center mb-4">
            <ButtonBack :url="store.back_url" />
        </div>
    </div>
</template>

<script setup>
import { onMounted } from 'vue';
import ButtonBack from '../components/button-back';
import ImagesPager from '../components/images-pager';
import PageHeader from '../components/page-header';
import useDefaultStore from '../stores/default';

const store = useDefaultStore();

onMounted(() => {
    store.setBackUrl('/illustrations');
});
</script>
