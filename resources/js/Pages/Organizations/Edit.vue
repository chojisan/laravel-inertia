<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        <inertia-link
          class="text-indigo-400 hover:text-indigo-600"
          :href="route('organizations')"
          >Organizations</inertia-link
        >
        <span class="text-indigo-400 font-medium">/</span>
        {{ form.name }}
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <trashed-message
          v-if="organization.deleted_at"
          class="mb-6"
          @restore="restore"
        >
          This organization has been deleted.
        </trashed-message>

        <organization-form
          title="Edit Organization"
          description="Edit organization description."
          :form="form"
          @submit="submit"
        />

        <jet-section-border />

        <delete-organization-form
          class="mt-10 sm:mt-0"
          :organization="organization"
        />

        <jet-section-border />

        <!-- Related Contact -->
        <h3 class="text-lg font-medium text-gray-900">Contacts</h3>
        <div class="mt-6 bg-white rounded shadow overflow-x-auto">
          <table class="min-w-full bg-white leading-normal">
            <thead>
              <tr>
                <th
                  class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider"
                >
                  Name
                </th>
                <th
                  class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider"
                >
                  City
                </th>
                <th
                  class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider"
                  colspan="2"
                >
                  Phone
                </th>
              </tr>
            </thead>
            <tbody>
              <tr
                v-for="contact in organization.contacts"
                :key="contact.id"
                class="hover:bg-gray-100 focus-within:bg-gray-100"
              >
                <td class="border-t border-gray-200 text-sm">
                  <inertia-link
                    class="px-6 py-4 flex items-center focus:text-indigo-500"
                    :href="route('contacts.edit', contact.id)"
                  >
                    {{ contact.name }}
                    <icon
                      v-if="contact.deleted_at"
                      name="trash"
                      class="flex-shrink-0 w-3 h-3 fill-gray-400 ml-2"
                    />
                  </inertia-link>
                </td>
                <td class="border-t border-gray-200 text-sm">
                  <inertia-link
                    class="px-6 py-4 flex items-center"
                    :href="route('contacts.edit', contact.id)"
                    tabindex="-1"
                  >
                    {{ contact.city }}
                  </inertia-link>
                </td>
                <td class="border-t border-gray-200 text-sm">
                  <inertia-link
                    class="px-6 py-4 flex items-center"
                    :href="route('contacts.edit', contact.id)"
                    tabindex="-1"
                  >
                    {{ contact.phone }}
                  </inertia-link>
                </td>
                <td class="border-t border-gray-200 text-sm w-px">
                  <inertia-link
                    class="px-4 flex items-center"
                    :href="route('contacts.edit', contact.id)"
                    tabindex="-1"
                  >
                    <icon
                      name="cheveron-right"
                      class="block w-6 h-6 fill-gray-400"
                    />
                  </inertia-link>
                </td>
              </tr>
              <tr v-if="organization.contacts.length === 0">
                <td
                  class="border-t border-gray-200 text-sm px-6 py-4"
                  colspan="4"
                >
                  No contacts found.
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "./../../Layouts/AppLayout";
import Icon from "./../../Shared/Icon";
import TrashedMessage from "./../../Shared/TrashedMessage";
import OrganizationForm from "./OrginizationForm";
import DeleteOrganizationForm from "./DeleteOrganizationForm";
import JetSectionBorder from "./../../Jetstream/SectionBorder";

export default {
  metaInfo() {
    return { title: this.form.name };
  },
  components: {
    AppLayout,
    Icon,
    TrashedMessage,
    OrganizationForm,
    DeleteOrganizationForm,
    JetSectionBorder
  },
  props: {
    errors: Object,
    organization: Object
  },
  //remember: "form",
  data() {
    return {
      sending: false,
      form: this.$inertia.form({
        name: this.organization.name,
        email: this.organization.email,
        phone: this.organization.phone,
        address: this.organization.address,
        city: this.organization.city,
        region: this.organization.region,
        country: this.organization.country,
        postal_code: this.organization.postal_code
      })
    };
  },
  methods: {
    submit(form) {
      this.sending = true;
      this.$inertia
        .put(this.route("organizations.update", this.organization.id), form)
        .then(() => (this.sending = false));
    },
    restore() {
      if (confirm("Are you sure you want to restore this organization?")) {
        this.$inertia.put(
          this.route("organizations.restore", this.organization.id)
        );
      }
    }
  }
};
</script>
