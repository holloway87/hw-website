<template>
    <div class="page-dev">
        <PageHeader title="Programming" />

        <WidgetContainer class="mb-10">
            <SubHeading class="mb-4">
                These are some of my programming projects.
            </SubHeading>

            <CardsContainer>
                <Card
                    class="mb-5"
                    image="/images/home_dev.png"
                    title="My website"
                    description="The code to this website can be found on my github."
                >
                    <ButtonLinkExternal
                        url="https://github.com/holloway87/hw-website"
                        rel="nofollow"
                        target="_blank"
                    >
                        <CodeBracketIcon class="h-6 inline-block align-bottom mr-1" />
                        GitHub source
                    </ButtonLinkExternal>
                </Card>

                <Card
                    class="mb-5"
                    image="/images/home_dev.png"
                    title="Little web games"
                    description="A collection of simple games made with TypeScript."
                >
                    <ButtonLinkExternal
                        url="https://gitlab.holloway-web.de/holloway/little-web-games"
                        target="_blank"
                    >
                        <CodeBracketIcon class="h-6 inline-block align-bottom mr-1" />
                        GitLab source
                    </ButtonLinkExternal>
                </Card>

                <Card
                    class="mb-5"
                    image="/images/home_dev.png"
                    title="Obsidian streak plugin"
                    description="A calender view for your streaks in Obsidian."
                >
                    <ButtonLinkExternal
                        url="https://gitlab.holloway-web.de/holloway/hw-streaks"
                        target="_blank"
                    >
                        <CodeBracketIcon class="h-6 inline-block align-bottom mr-1" />
                        GitLab source
                    </ButtonLinkExternal>
                </Card>
            </CardsContainer>

            <div class="text-center">
                <ButtonBack :url="store.back_url" />
            </div>
        </WidgetContainer>
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
import SubHeading from '../components/sub-heading';
import WidgetContainer from '../components/widget-container';
import useDefaultStore from '../stores/default';

const store = useDefaultStore();

onMounted(() => {
    store.setBackUrl('/');
});
</script>
