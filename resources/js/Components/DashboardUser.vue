<template>
<div class="w-25">
    <div ref="dropzone" class="p-5 bg-dark text-center text-light">
        Upload
    </div>
</div>
</template>

<script>
import Dropzone from "dropzone";

export default{
    name: 'DashboardUser',

    data(){
        return {
            dropzone:null
        }
    },
    mounted() {
        this.dropzone = new Dropzone(this.$refs.dropzone,{url:'123'})
    }
}
</script>

<style scoped>

</style>
