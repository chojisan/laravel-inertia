<template>
  <div class="flex h-screen bg-gray-200">
    <!-- Sidebar -->
    <sidebar />
    <div class="flex-1 flex flex-col overflow-hidden">
      <!-- Header -->
      <admin-header />
      <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
        <div class="container mx-auto">
          <!-- Page Heading -->
          <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
              <flash-messages />
              <slot name="header"></slot>
            </div>
          </header>

          <!-- Page Content -->
          <main>
            <slot></slot>
          </main>

          <!-- Modal Portal -->
          <portal-target name="modal" multiple></portal-target>
        </div>
      </main>
    </div>
  </div>
</template>

<script>
import FlashMessages from "@/Shared/FlashMessages";
import AdminHeader from "@/Shared/AdminHeader";
import Sidebar from "@/Shared/Sidebar";

export default {
  components: {
    FlashMessages,
    AdminHeader,
    Sidebar
  },

  data() {
    return {
      showingNavigationDropdown: false
    };
  },

  methods: {
    switchToTeam(team) {
      this.$inertia.put(
        route("current-team.update"),
        {
          team_id: team.id
        },
        {
          preserveState: false
        }
      );
    },

    logout() {
      axios.post(route("logout").url()).then(response => {
        window.location = "/";
      });
    }
  },

  computed: {
    path() {
      return window.location.pathname;
    }
  }
};
</script>
