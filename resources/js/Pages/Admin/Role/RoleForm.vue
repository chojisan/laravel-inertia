<template>
  <div>
    <jet-form-section @submitted="submit">
      <template #title>
        {{ title }}
      </template>

      <template #description>
        {{ description }}
      </template>

      <template #form>
        <div class="col-span-6 sm:col-span-6">
          <jet-label for="name" value="Role Name" />
          <jet-input
            id="name"
            type="text"
            class="mt-1 block w-full"
            v-model="form.name"
            autofocus
          />
          <jet-input-error :message="form.error('name')" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-6">
          <jet-label for="guard_name" value="Guard Name" />
          <jet-input
            id="guard_name"
            type="text"
            class="mt-1 block w-full"
            v-model="form.guard_name"
            autofocus
          />
        </div>

        <div class="col-span-6 sm:col-span-6">
          <jet-label for="permssions" value="Permissions" />
          <multiselect
            class="rounded-md shadow-sm mt-1 block w-full"
            v-model="form.permissions"
            placeholder="Search permssion"
            label="name"
            track-by="id"
            :options="permissions"
            :multiple="true"
          ></multiselect>
        </div>
      </template>
      <template #actions>
        <jet-button>
          Save
        </jet-button>
      </template>
    </jet-form-section>
  </div>
</template>

<script>
import JetFormSection from "@/Jetstream/FormSection";
import JetActionSection from "@/Jetstream/ActionSection";
import JetButton from "@/Jetstream/Button";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetLabel from "@/Jetstream/Label";
import Multiselect from "vue-multiselect";

export default {
  props: {
    title: {
      type: String
    },
    description: {
      type: String,
      default: ""
    },
    form: {
      type: Object,
      description: "Form data"
    },
    permissions: {
      type: Array
    }
  },
  components: {
    JetButton,
    JetFormSection,
    JetActionSection,
    JetInput,
    JetInputError,
    JetLabel,
    Multiselect
  },
  methods: {
    submit() {
      this.$emit("submit", this.form);
    }
  }
};
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
