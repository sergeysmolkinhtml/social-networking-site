<template>
    <Head>
        <title>Groups list</title>
    </Head>
    <AppLayout>
        <Link v-if="permissions.groups_manage" :href="route('groups.create')"
              class="inline-block px-4 py-3 bg-blue-500 text-white rounded mb-4">Add new group
        </Link>

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
                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                    <Link v-if="permissions.groups_manage" :href="route('groups.edit', gr.id)"
                          class="px-2 py-1 bg-blue-600 text-white rounded font-bold uppercase mr-2">Edit
                    </Link>
                    <button v-if="permissions.groups_manage" @click="destroy(post.id)" type="button"
                            class="px-2 py-1 bg-red-600 text-white rounded font-bold uppercase">
                        Delete
                    </button>
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
import {Head, Link} from "@inertiajs/inertia-vue3"

export default {
    components: {
        AppLayout,
        Head,
        Link,
    },
    props: {
        groups: Object,
        persmissions: Object
    },
    setup() {
        const destroy = (id) => {
            if (confirm('Are you sure?')) {
                Inertia.delete(route('groups.destroy', id))
            }
        }
        return {destroy}
    }
}
</script>
