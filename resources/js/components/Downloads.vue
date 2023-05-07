<script>
export default {
    name: 'DownloadsComponent',
}
</script>

<script setup>
import axios from 'axios';

defineProps({
    contracts: {
        type: Array,
        default: [],
    },
});

const download = (url) => {
    axios.get(url)
        .then(response => {
            const {download_link} = response.data;
            window.open(download_link, '_blank');
            // window.location.href = download_link;
        })
        .catch(err => {
            console.log(err)
            alert('Something went wrong')
        })
};
</script>

<template>
    <div class="downloads">
        <div
            class="download-box"
            v-for="contract in contracts"
            :key="contract.id"
        >
            <div class="download-box__title">
                {{ contract.name }}
            </div>

            <div class="download-box__button">
                <button
                    class="button"
                    @click="download(contract.url)"
                >
                    Download
                </button>
            </div>
        </div>
    </div>
</template>
