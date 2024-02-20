<template>
    <div class="page-dev">
        <PageHeader title="Programming">
            These are some of my programming projects.
        </PageHeader>

        <CardsContainer>
            <Card class="mb-5" title="My website" description="The code to this website can be found on my github.">
                <ButtonLink
                    url="https://github.com/holloway87/hw-website"
                    rel="nofollow"
                    target="_blank"
                >
                    <b-icon-github class="inline-block align-text-top text-xl mr-1" />
                    GitHub source
                </ButtonLink>
            </Card>
        </CardsContainer>

        <div class="text-center mb-4">
            <ButtonBack url="/" />
        </div>
    </div>
</template>

<script>
import { BIconGithub } from 'bootstrap-vue';
import ButtonBack from '../components/button-back';
import ButtonLink from '../components/button-link';
import Card from '../components/card';
import CardsContainer from '../components/cards-container';
import PageHeader from '../components/page-header';

export default {
    components: { BIconGithub, ButtonBack, ButtonLink, Card, CardsContainer, PageHeader },
};
</script>
