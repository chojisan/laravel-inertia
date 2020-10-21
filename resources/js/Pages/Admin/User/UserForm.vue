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
        <div class="col-span-3 sm:col-span-3">
          <jet-label for="username" value="Username" />
          <jet-input
            id="username"
            type="text"
            class="mt-1 block w-full"
            v-model="form.username"
            autofocus
          />
          <jet-input-error :message="form.error('username')" class="mt-2" />
        </div>

        <div class="col-span-3 sm:col-span-3">
          <jet-label for="slug" value="Slug" />
          <jet-input
            id="slug"
            type="text"
            class="mt-1 block w-full"
            v-model="form.slug"
          />
          <jet-input-error :message="form.error('slug')" class="mt-2" />
        </div>
        <!-- First Name -->
        <div class="col-span-2 sm:col-span-2">
          <jet-label for="first_name" value="First Name" />
          <jet-input
            id="first_name"
            type="text"
            class="mt-1 block w-full"
            v-model="form.first_name"
            autocomplete="first_name"
          />
          <jet-input-error :message="form.error('first_name')" class="mt-2" />
        </div>

        <!-- Middle Name -->
        <div class="col-span-2 sm:col-span-2">
          <jet-label for="middle_name" value="Middle Name" />
          <jet-input
            id="middle_name"
            type="text"
            class="mt-1 block w-full"
            v-model="form.middle_name"
            autocomplete="middle_name"
          />
        </div>

        <!-- Last Name -->
        <div class="col-span-2 sm:col-span-2">
          <jet-label for="last_name" value="Last Name" />
          <jet-input
            id="last_name"
            type="text"
            class="mt-1 block w-full"
            v-model="form.last_name"
            autocomplete="last_name"
          />
          <jet-input-error :message="form.error('last_name')" class="mt-2" />
        </div>

        <!-- Name Extension -->
        <div class="col-span-2 sm:col-span-2">
          <jet-label for="name_extension" value="Name Extension" />
          <jet-input
            id="name_extension"
            type="text"
            class="mt-1 block w-full"
            v-model="form.name_extension"
            autocomplete="name_extension"
          />
        </div>

        <!-- Gender -->
        <div class="col-span-2 sm:col-span-2">
          <jet-label for="gender" value="Gender" />
          <select-input
            id="gender"
            v-model="form.gender"
            class="mt-1 block w-full"
          >
            <option :value="null" />
            <option value="M">Male</option>
            <option value="F">Female</option>
          </select-input>
        </div>

        <!-- Birth Data -->
        <div class="col-span-2 sm:col-span-2">
          <jet-label for="birth_date" value="Birth Date" />
          <jet-input
            id="birth_date"
            type="text"
            class="mt-1 block w-full"
            v-model="form.birth_date"
            autocomplete="birth_date"
          />
        </div>

        <!-- Email -->
        <div class="col-span-6 sm:col-span-6">
          <jet-label for="email" value="Email" />
          <jet-input
            id="email"
            type="email"
            class="mt-1 block w-full"
            v-model="form.email"
          />
          <jet-input-error :message="form.error('email')" class="mt-2" />
        </div>

        <!-- Mobile Number -->
        <div class="col-span-3 sm:col-span-3">
          <jet-label for="mobile_number" value="Mobile Number" />
          <jet-input
            id="mobile_number"
            type="text"
            class="mt-1 block w-full"
            v-model="form.mobile_number"
            autocomplete="mobile_number"
          />
          <jet-input-error
            :message="form.error('mobile_number')"
            class="mt-2"
          />
        </div>

        <!-- Phone Number -->
        <div class="col-span-3 sm:col-span-3">
          <jet-label for="phone_number" value="Phone Number" />
          <jet-input
            id="phone_number"
            type="text"
            class="mt-1 block w-full"
            v-model="form.phone_number"
            autocomplete="phone_number"
          />
        </div>

        <!-- Password -->
        <div class="col-span-3 sm:col-span-3">
          <jet-label for="password" value="Password" />
          <jet-input
            id="password"
            type="password"
            class="mt-1 block w-full"
            v-model="form.password"
          />
          <jet-input-error :message="form.error('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="col-span-3 sm:col-span-3">
          <jet-label for="confirm_password" value="Confirm Password" />
          <jet-input
            id="confirm_password"
            type="password"
            class="mt-1 block w-full"
            v-model="form.confirm_password"
          />
          <jet-input-error
            :message="form.error('confirm_password')"
            class="mt-2"
          />
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
import SelectInput from "@/Shared/Select";

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
    JetLabel,
    SelectInput
  },
  data() {
    return {
      checkin: ""
    };
  },
  methods: {
    submit() {
      this.$emit("submit", this.form);
    }
  }
};
</script>
