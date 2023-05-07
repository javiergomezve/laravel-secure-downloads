<script>
export default {
    name: "WorldComponent"
}
</script>

<script setup>
import { ref } from 'vue'

const input = ref('')
</script>

<template>
    <p>{{ input }}</p>
    <input v-model="input" />
</template>
