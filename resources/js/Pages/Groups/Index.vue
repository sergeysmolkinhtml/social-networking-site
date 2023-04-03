<template>
    <Head>
        <title>Groups list</title>
    </Head>
    <AppLayout>
        <table class="mt-4 min-w-full divide-y divide-gray-200 border">
            <thead>
            <tr>
                <th class="px-6 py-3 bg-gray-50 text-left">
                    <span class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">ID</span>
                </th>
                <th class="px-6 py-3 bg-gray-50 text-left">
                    <span class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Title</span>
                </th>
                <th class="px-6 py-3 bg-gray-50 text-left">
                    <span class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Content</span>
                </th>
                <th class="px-6 py-3 bg-gray-50 text-left">
                    <span class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Created at</span>
                </th>
            </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200 divide-solid">
            <tr v-for="gr in groups">
                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                            {{ gr.id }}
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                            {{ gr.title }}
                        </td>
                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                    {{ gr.description }}
                </td>
                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                    {{ gr.created_at }}
                </td>
            </tr>
            </tbody>
        </table>
    </AppLayout>
</template>


<style scoped>

</style>

<script>


import AppLayout from "../../Layouts/App.vue"
import {Head} from "@inertiajs/inertia-vue3"

export default {
    components: {
        AppLayout,
        Head
    },
    props:{
        groups:Object
    }
}
</script>
