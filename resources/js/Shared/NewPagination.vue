<template>
    <div class="flex flex-wrap">
        <template v-for="(link, key) in links">
            <div
                v-if="link.url === null"
                :key="key"
                class="text-sm bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-3 px-4"
                :class="{
                    'rounded-l': link.label === 'Previous',
                    'rounded-r': link.label === 'Next'
                }"
            >
                {{ link.label }}
            </div>
            <inertia-link
                v-else
                :key="key"
                class="mx-1 px-4 py-3 text-sm border hover:bg-white focus:border-indigo-500 focus:text-indigo-500"
                :class="{
                    'bg-white': link.active,
                    'rounded-l': link.label === 'Previous',
                    'rounded-r': link.label === 'Next'
                }"
                :href="link.url"
                >{{ link.label }}</inertia-link
            >
        </template>
    </div>
</template>

<script>
export default {
    props: {
        links: Array
    }
};
</script>
