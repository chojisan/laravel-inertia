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
          <jet-label for="title" value="Article Title" />
          <jet-input
            id="title"
            type="text"
            class="mt-1 block w-full"
            v-model="form.title"
            autofocus
          />
          <jet-input-error :message="form.error('title')" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-6">
          <input
            type="checkbox"
            id="featured"
            v-model="form.featured"
            value="1"
            class="form-switch-checkbox"
          />
          <label for="featured" class="font-medium text-sm text-gray-700"
            >Featured</label
          >
        </div>

        <div class="col-span-6 sm:col-span-6">
          <jet-label for="short_description" value="Short Description" />
          <textarea
            id="short_description"
            type="text"
            class="form-textarea rounded-md shadow-sm mt-1 block w-full"
            v-model="form.short_description"
            autofocus
          ></textarea>
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
              :src="form.article_image_path"
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
        </div>

        <div class="col-span-3 sm:col-span-3">
          <jet-label for="category_id" value="Category" />
          <select-input
            id="category_id"
            v-model="form.category_id"
            class="mt-1 block w-full"
          >
            <option :value="null" />
            <option
              v-for="category in categories"
              :key="category.id"
              :value="category.id"
              >{{ category.name }}</option
            >
          </select-input>
          <jet-input-error :message="form.error('category_id')" class="mt-2" />
        </div>

        <div class="col-span-3 sm:col-span-3">
          <jet-label for="tags" value="Article Tags" />
          <multiselect
            class="rounded-md shadow-sm mt-1 block w-full"
            v-model="form.tags"
            tag-placeholder="Add this as new tag"
            placeholder="Search or add a tag"
            label="name"
            track-by="id"
            :options="tags"
            :multiple="true"
            :taggable="true"
            @tag="addTag"
          ></multiselect>
        </div>

        <div class="col-span-3 sm:col-span-3">
          <jet-label for="meta_description" value="Meta Description" />
          <textarea
            id="meta_description"
            type="text"
            class="form-textarea rounded-md shadow-sm mt-1 block w-full"
            v-model="form.meta_description"
            autofocus
          ></textarea>
        </div>

        <div class="col-span-3 sm:col-span-3">
          <jet-label for="meta_keywords" value="Meta Keywords" />
          <textarea
            id="meta_keywords"
            type="text"
            class="form-textarea rounded-md shadow-sm mt-1 block w-full"
            v-model="form.meta_keywords"
            autofocus
          ></textarea>
        </div>

        <div class="col-span-6 sm:col-span-6">
          <jet-label for="status" value="Status" />
          <select-input
            id="status"
            v-model="form.status"
            class="mt-1 block w-full"
          >
            <option :value="null" />
            <option
              v-for="(option, index) in options"
              :key="index"
              :value="option.value"
              >{{ option.name }}</option
            >
          </select-input>
          <jet-input-error :message="form.error('status')" class="mt-2" />
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
    categories: {
      type: Array
    },
    tags: {
      type: Array
    },
    options: {
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
    SelectInput,
    Multiselect
  },
  data() {
    return {
      currentPhoto: this.form.article_image_path
        ? this.form.article_image_path
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
    },
    addTag(newTag) {
      axios
        .post(this.route("api.cms.tags"), { name: newTag })
        .then(response => {
          this.sending = false;
          const tag = {
            name: response.data.name,
            id: response.data.id
          };
          this.tags.push(tag);
          this.form.tags.push(tag);
        });
    }
  }
};
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
