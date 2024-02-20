<template>
    <div class="page-home">
        <PageHeader title="Welcome">
            Choose a category:
        </PageHeader>

        <CardsContainer>
            <CardImageLink
                class="mb-5"
                description="Have a look at my illustrations."
                image="/images/home_art.png"
                title="Art"
                url="/illustrations"
            />
            <CardImageLink
                class="mb-5"
                description="I sometimes like to take photos."
                image="/images/home_photos.png"
                title="Photos"
                url="/photo-projects"
            />
            <CardImageLink
                class="mb-5"
                description="These are some of my programming projects."
                image="/images/home_dev.png"
                title="Programming"
                url="/dev"
            />
        </CardsContainer>
    </div>
</template>

<script>
import CardImageLink from '../components/card-image-link';
import CardsContainer from '../components/cards-container';
import PageHeader from '../components/page-header';

export default {
    components: { CardImageLink ,CardsContainer, PageHeader },
};
</script>
