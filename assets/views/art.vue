<template>
    <div class="page-art">
        <PageHeader title="Art">
            Listed below are some of my illustrations, comics or silly doodles.
        </PageHeader>

        <CardsContainer>
            <CardImageLink
                class="mb-5"
                description="One panel comic strips about my ghost Abe."
                image="/images/art_the_life_of_abe.png"
                title="The Life of Abe"
                url="/illustrations/the-life-of-abe"
            />
            <CardImageLink
                class="mb-5"
                description="Silly doodles about Maaya's community."
                image="/images/art_maaya_community_doodles.png"
                title="Maaya's community doodles"
                url="/illustrations/maaya-community-doodles"
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
