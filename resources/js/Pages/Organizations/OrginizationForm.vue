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
          <jet-label for="name" value="Name" />
          <jet-input
            id="name"
            type="text"
            class="mt-1 block w-full"
            v-model="form.name"
            autofocus
          />
          <jet-input-error :message="form.error('name')" class="mt-2" />
        </div>

        <div class="col-span-3 sm:col-span-3">
          <jet-label for="email" value="Email" />
          <jet-input
            id="email"
            type="text"
            class="mt-1 block w-full"
            v-model="form.email"
            autofocus
          />
          <jet-input-error :message="form.error('email')" class="mt-2" />
        </div>

        <div class="col-span-3 sm:col-span-3">
          <jet-label for="phone" value="Phone" />
          <jet-input
            id="phone"
            type="text"
            class="mt-1 block w-full"
            v-model="form.phone"
            autofocus
          />
          <jet-input-error :message="form.error('phone')" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-6">
          <jet-label for="address" value="Address" />
          <jet-input
            id="address"
            type="text"
            class="mt-1 block w-full"
            v-model="form.address"
            autofocus
          />
          <jet-input-error :message="form.error('address')" class="mt-2" />
        </div>

        <div class="col-span-3 sm:col-span-3">
          <jet-label for="city" value="City" />
          <jet-input
            id="city"
            type="text"
            class="mt-1 block w-full"
            v-model="form.city"
            autofocus
          />
          <jet-input-error :message="form.error('city')" class="mt-2" />
        </div>

        <div class="col-span-3 sm:col-span-3">
          <jet-label for="postal_code" value="Postal Code" />
          <jet-input
            id="postal_code"
            type="text"
            class="mt-1 block w-full"
            v-model="form.postal_code"
            autofocus
          />
          <jet-input-error :message="form.error('postal_code')" class="mt-2" />
        </div>

        <div class="col-span-3 sm:col-span-3">
          <jet-label for="region" value="Region" />
          <jet-input
            id="region"
            type="text"
            class="mt-1 block w-full"
            v-model="form.region"
            autofocus
          />
          <jet-input-error :message="form.error('region')" class="mt-2" />
        </div>

        <div class="col-span-3 sm:col-span-3">
          <jet-label for="country" value="Country" />
          <jet-input
            id="country"
            type="text"
            class="mt-1 block w-full"
            v-model="form.country"
            autofocus
          />
          <jet-input-error :message="form.error('country')" class="mt-2" />
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
import JetFormSection from "./../../Jetstream/FormSection";
import JetActionSection from "./../../Jetstream/ActionSection";
import JetButton from "./../../Jetstream/Button";
import JetInput from "./../../Jetstream/Input";
import JetInputError from "./../../Jetstream/InputError";
import JetLabel from "./../../Jetstream/Label";

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
      /* this.sending = true;
      this.$inertia
        .post(this.route("organizations.store"), this.form)
        .then(() => (this.sending = false)); */
    }
  }
};
</script>

<style></style>
