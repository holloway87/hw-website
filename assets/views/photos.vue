<template>
    <div class="page-photos">
        <PageHeader title="Photos">
            These are some of my photo projects:
        </PageHeader>

        <CardsContainer>
            <CardImageLink
                class="mb-5"
                description="Photos I took with a macro lens."
                image="/images/photos_macro.png"
                title="Macro photos"
                url="/photo-projects/macro"
            />
            <CardImageLink
                class="mb-5"
                description="Color analog photos."
                image="/images/photos_analog.png"
                title="Analog"
                url="/photo-projects/analog"
            />
            <CardImageLink
                class="mb-5"
                description="Black and white analog photos."
                image="/images/photos_bw_analog.png"
                title="B/W analog"
                url="/photo-projects/bw-analog"
            />
            <CardImageLink
                class="mb-5"
                description="Photos of those squishy things in the sky."
                image="/images/home_photos.png"
                title="Cloud photos"
                url="/photo-projects/clouds"
            />
            <CardImageLink
                class="mb-5"
                description="Photos of my cat Mia."
                image="/images/photos_mia.png"
                title="My cat Mia"
                url="/photo-projects/mia"
            />
        </CardsContainer>

        <div class="text-center mb-4">
            <ButtonBack :url="store.back_url" />
        </div>
    </div>
</template>

<script setup>
import { onMounted } from 'vue';
import ButtonBack from '../components/button-back';
import CardImageLink from '../components/card-image-link';
import CardsContainer from '../components/cards-container';
import PageHeader from '../components/page-header';
import useDefaultStore from '../stores/default';

const store = useDefaultStore();

onMounted(() => {
    store.setBackUrl('/');
});
</script>
