<template>
    <div class="overflow-hidden overflow-x-auto p-6 bg-white border-gray-200">
        <div class="min-w-full align-middle">
            <Link :href="route('groups.index')" :class="{'font-bold': $page.component === 'Groups/Index'}">Groups</Link>
            <br>
            <Link :href="route('pages.about')" :class="{'font-bold': $page.component === 'About'}">About</Link>
            <slot/>
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
