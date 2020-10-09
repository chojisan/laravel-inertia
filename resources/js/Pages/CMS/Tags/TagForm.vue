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
          <jet-label for="name" value="Tag Name" />
          <jet-input
            id="name"
            type="text"
            class="mt-1 block w-full"
            v-model="form.name"
            autofocus
          />
          <jet-input-error :message="form.error('name')" class="mt-2" />
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
    }
  },
  components: {
    JetButton,
    JetFormSection,
    JetActionSection,
    JetInput,
    JetInputError,
    JetLabel
  },
  methods: {
    submit() {
      this.$emit("submit", this.form);
    }
  }
};
</script>

<style></style>
