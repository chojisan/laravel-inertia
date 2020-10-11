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
          <jet-label for="name" value="Category Name" />
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
          <jet-label for="parent_id" value="Parent Category" />
          <select-input
            id="parent_id"
            v-model="form.parent_id"
            class="mt-1 block w-full"
          >
            <option :value="0" />
            <option
              v-for="category in categories"
              :key="category.id"
              :value="category.id"
              >{{ category.name }}</option
            >
          </select-input>
        </div>

        <div class="col-span-6 sm:col-span-6">
          <jet-label for="description" value="Description" />
          <textarea
            id="description"
            type="text"
            class="form-textarea rounded-md shadow-sm mt-1 block w-full"
            v-model="form.description"
            autofocus
          ></textarea>
        </div>

        <div class="col-span-6 sm:col-span-6">
          <jet-label for="image" value="Category Image" />

          <!-- Current Profile Photo -->
          <div class="mt-2" v-show="currentPhoto">
            <img
              :src="form.category_image_path"
              class="rounded-full h-20 w-20"
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
          <input
            id="image"
            type="file"
            class="mt-1 block w-full"
            ref="photo"
            @change="updatePhotoPreview"
          />
          <jet-input-error :message="form.error('image')" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-6">
          <input
            type="checkbox"
            id="published"
            v-model="form.published"
            value="1"
            class="form-switch-checkbox"
          />
          <label for="published" class="font-medium text-sm text-gray-700"
            >Published</label
          >
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
    },
    categories: {
      type: Array,
      description: "Parent category"
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
      currentPhoto: this.form.category_image_path
        ? this.form.category_image_path
        : null,
      photoPreview: null
    };
  },
  methods: {
    submit() {
      if (this.$refs.photo) {
        this.form.image = this.$refs.photo.files[0];
      }
      this.$emit("submit", this.form);
    },
    updatePhotoPreview() {
      const reader = new FileReader();

      reader.onload = e => {
        this.photoPreview = e.target.result;
      };

      reader.readAsDataURL(this.$refs.photo.files[0]);

      this.currentPhoto = null;
    }
  }
};
</script>

<style></style>
