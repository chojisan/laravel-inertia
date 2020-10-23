<template>
  <jet-form-section @submitted="updateProfileInformation">
    <template #title>
      Profile Information
    </template>

    <template #description>
      Update your account's profile information and email address.
    </template>

    <template #form>
      <!-- Profile Photo -->
      <div
        class="col-span-6 sm:col-span-4"
        v-if="$page.jetstream.managesProfilePhotos"
      >
        <!-- Profile Photo File Input -->
        <input
          type="file"
          class="hidden"
          ref="photo"
          @change="updatePhotoPreview"
        />

        <jet-label for="photo" value="Photo" />

        <!-- Current Profile Photo -->
        <div class="mt-2" v-show="!photoPreview">
          <img
            :src="user.profile_photo_url"
            alt="Current Profile Photo"
            class="rounded-full h-20 w-20 object-cover"
          />
        </div>

        <!-- New Profile Photo Preview -->
        <div class="mt-2" v-show="photoPreview">
          <span
            class="block rounded-full w-20 h-20"
            :style="
              'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' +
                photoPreview +
                '\');'
            "
          >
          </span>
        </div>

        <jet-secondary-button
          class="mt-2 mr-2"
          type="button"
          @click.native.prevent="selectNewPhoto"
        >
          Select A New Photo
        </jet-secondary-button>

        <jet-secondary-button
          type="button"
          class="mt-2"
          @click.native.prevent="deletePhoto"
          v-if="user.profile_photo_path"
        >
          Remove Photo
        </jet-secondary-button>

        <jet-input-error :message="form.error('photo')" class="mt-2" />
      </div>

      <!-- Username -->
      <div class="col-span-3 sm:col-span-3">
        <jet-label for="username" value="Username" />
        <jet-input
          id="username"
          type="text"
          class="mt-1 block w-full"
          v-model="form.username"
          autocomplete="username"
        />
        <jet-input-error :message="form.error('username')" class="mt-2" />
      </div>

      <!-- User Slug -->
      <div class="col-span-3 sm:col-span-3">
        <jet-label for="slug" value="Slug" />
        <jet-input
          id="slug"
          type="text"
          class="mt-1 block w-full"
          v-model="form.slug"
          autocomplete="slug"
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
    </template>

    <template #actions>
      <jet-action-message :on="form.recentlySuccessful" class="mr-3">
        Saved.
      </jet-action-message>

      <jet-button
        :class="{ 'opacity-25': form.processing }"
        :disabled="form.processing"
      >
        Save
      </jet-button>
    </template>
  </jet-form-section>
</template>

<script>
import JetButton from "@/Jetstream/Button";
import JetFormSection from "@/Jetstream/FormSection";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetLabel from "@/Jetstream/Label";
import JetActionMessage from "@/Jetstream/ActionMessage";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";
import SelectInput from "@/Shared/Select";

export default {
  components: {
    JetActionMessage,
    JetButton,
    JetFormSection,
    JetInput,
    JetInputError,
    JetLabel,
    JetSecondaryButton,
    SelectInput
  },

  props: ["user"],

  data() {
    return {
      form: this.$inertia.form(
        {
          _method: "PUT",
          username: this.user.username,
          slug: this.user.slug,
          first_name: this.user.first_name,
          middle_name: this.user.middle_name,
          last_name: this.user.last_name,
          name_extension: this.user.name_extension,
          gender: this.user.gender,
          birth_date: this.user.birth_date,
          email: this.user.email,
          mobile_number: this.user.mobile_number,
          phone_number: this.user.phone_number,
          photo: null
        },
        {
          bag: "updateProfileInformation",
          resetOnSuccess: false
        }
      ),

      photoPreview: null
    };
  },

  methods: {
    updateProfileInformation() {
      if (this.$refs.photo) {
        this.form.photo = this.$refs.photo.files[0];
      }

      this.form.post(route("user-profile-information.update"), {
        preserveScroll: true
      });
    },

    selectNewPhoto() {
      this.$refs.photo.click();
    },

    updatePhotoPreview() {
      const reader = new FileReader();

      reader.onload = e => {
        this.photoPreview = e.target.result;
      };

      reader.readAsDataURL(this.$refs.photo.files[0]);
    },

    deletePhoto() {
      this.$inertia
        .delete(route("current-user-photo.destroy"), {
          preserveScroll: true
        })
        .then(() => {
          this.photoPreview = null;
        });
    }
  }
};
</script>
