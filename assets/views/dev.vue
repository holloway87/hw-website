<template>
    <div class="page-dev">
        <PageHeader title="Programming">
            These are some of my programming projects.
        </PageHeader>

        <CardsContainer>
            <Card class="mb-5" title="My website" description="The code to this website can be found on my github.">
                <ButtonLinkExternal
                    url="https://github.com/holloway87/hw-website"
                    rel="nofollow"
                    target="_blank"
                >
                    <CodeBracketIcon class="h-6 inline-block align-bottom mr-1" />
                    GitHub source
                </ButtonLinkExternal>
            </Card>
        </CardsContainer>

        <div class="text-center mb-4">
            <ButtonBack :url="store.back_url" />
        </div>
    </div>
</template>

<script setup>
import { onMounted } from 'vue';
import ButtonBack from '../components/button-back';
import ButtonLinkExternal from '../components/button-link-external';
import { CodeBracketIcon } from '@heroicons/vue/24/outline';
import Card from '../components/card';
import CardsContainer from '../components/cards-container';
import PageHeader from '../components/page-header';
import useDefaultStore from '../stores/default';

const store = useDefaultStore();

onMounted(() => {
    store.setBackUrl('/');
});
</script>
