<template>
    <div class="flex-1 p:2 sm:p-6 justify-between flex flex-col h-screen">
        <div class="flex sm:items-center justify-between py-3 border-b-2 border-gray-200">
            <div class="flex items-center space-x-4">
                <div class="flex flex-col leading-tight">
                    <div class="text-2xl mt-1 flex items-center">
                        <span class="text-gray-700 mr-3">User</span>
                    </div>

                    <span class="text-lg text-gray-600">Email</span>
                </div>
            </div>
        </div>

        <div class="flex flex-col space-y-4 p-3 overflow-y-auto scrollbar-thumb-blue scrollbar-thumb-rounded scrollbar-track-blue-lighter scrollbar-w-2 scrolling-touch">
            <chat-messages user={{user.id}}></chat-messages>
        </div>

        <div class="border-t-2 border-gray-200 px-4 pt-4 mb-2 sm:mb-0">
            <chat-form></chat-form>
        </div>
    </div>

</template>

<script>
import ChatForm from "@/Pages/Chat/ChatForm.vue";
import ChatMessages from "@/Pages/Chat/ChatMessages.vue";


export default {
    name: "Index",
    props:{
        user: Object
    },
    components: {
        ChatForm,
        ChatMessages
    }
}
</script>

<style scoped>

</style>
