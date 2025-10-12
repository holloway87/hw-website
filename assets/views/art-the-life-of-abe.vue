<template>
    <div class="page-art-the-life-of-abe">
        <PageHeader title="The Life of Abe" />

        <WidgetContainer class="mb-10">
            <SubHeading class="mb-4">
                These comic strips are about my ghost character Abe, who will be
                depicted in various actions.
            </SubHeading>

            <ImagesPager
                images_data_url="/illustrations/the-life-of-abe/get-image-files"
                no_images_message="There are currently no comic strips."
                title="The Life of Abe"
            />
    
            <div class="text-center">
                <ButtonBack :url="store.back_url" />
            </div>
        </WidgetContainer>
    </div>
</template>

<script setup>
import { onMounted } from 'vue';
import ButtonBack from '../components/button-back';
import ImagesPager from '../components/images-pager';
import PageHeader from '../components/page-header';
import SubHeading from '../components/sub-heading';
import WidgetContainer from '../components/widget-container';
import useDefaultStore from '../stores/default';

const store = useDefaultStore();

onMounted(() => {
    store.setBackUrl('/illustrations');
});
</script>
