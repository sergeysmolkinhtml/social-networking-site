<template>
    <div class="overflow-hidden overflow-x-auto p-6 bg-white border-gray-200">
        <div class="min-w-full align-middle">
            <Link :href="route('groups.index')" class="ml-2">Groups</Link>
            <Link :href="route('pages.about')" class="ml-2">About</Link>

            <h2>About us</h2>
        </div>
    </div>
</template>

<script>

import {Link} from "@inertiajs/inertia-vue3";

export default {
    components: {
        Link
    },

}
</script>
