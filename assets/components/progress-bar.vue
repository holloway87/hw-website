<template>
    <div class="border border-[#1f2e2b] rounded-md h-6 overflow-hidden mb-1">
        <div class="bg-white h-full" :style={width:progress}></div>
    </div>
</template>

<script setup>
defineProps({
    'progress': {
        'required': true,
        'type': String
    }
});
</script>
