<template>
  <div class="flex">
    <div class="flex w-full bg-white shadow rounded">
      <slot />
      <div class="block relative mt-2 sm:mt-0">
        <span class="absolute inset-y-0 left-0 flex items-center pl-2">
          <icon name="search" class="h-4 w-4 text-gray-500" />
        </span>
        <input
          class="appearance-none rounded-r border-l border-gray-400 sm:rounded-l-none block pl-8 pr-6 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none"
          autocomplete="off"
          type="text"
          name="search"
          placeholder="Search…"
          :value="value"
          @input="$emit('input', $event.target.value)"
        />
      </div>
    </div>
    <button
      class="ml-3 text-sm text-gray-500 hover:text-gray-700 focus:text-indigo-500"
      type="button"
      @click="$emit('reset')"
    >
      Reset
    </button>
  </div>
</template>

<script>
import Icon from "@/Shared/Icon";

export default {
  props: {
    value: String,
    maxWidth: {
      type: Number,
      default: 300
    }
  },
  components: {
    Icon
  }
};
</script>
