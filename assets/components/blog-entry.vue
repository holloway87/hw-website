<template>
    <TimelineEntry :date="date" :link="link" :time="time" :title="title">
        <div v-html="content" class="text-text"></div>
    </TimelineEntry>
</template>

<script setup>
import { inject, onMounted, ref } from 'vue';
import TimelineEntry from '../components/timeline-entry';

const content = ref('');
const marked = inject('marked');
const props = defineProps({
    'content': {
        'required': true,
        'type': String,
    },
    'date': {
        'required': true,
        'type': String,
    },
    'link': {
        'required': true,
        'type': String,
    },
    'time': {
        'required': true,
        'type': String,
    },
    'title': {
        'required': true,
        'type': String,
    }
});

onMounted(() => {
    content.value = marked.parse(props.content);
});
</script>
