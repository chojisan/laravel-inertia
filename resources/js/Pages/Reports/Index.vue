<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Reports
            </h2>
        </template>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";

export default {
    metaInfo: { title: "Reports" },
    components: {
        AppLayout
    }
};
</script>
