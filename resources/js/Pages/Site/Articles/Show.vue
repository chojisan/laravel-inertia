<template>
  <site-layout>
    <main class="profile-page">
      <section class="relative block" style="height: 500px;">
        <div
          class="absolute top-0 w-full h-full bg-center bg-cover"
          style='background-image: url("https://images.unsplash.com/photo-1499336315816-097655dcfbda?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=2710&amp;q=80");'
        >
          <span
            id="blackOverlay"
            class="w-full h-full absolute opacity-50 bg-black"
          ></span>
        </div>
        <div
          class="top-auto bottom-0 left-0 right-0 w-full absolute pointer-events-none overflow-hidden"
          style="height: 70px; transform: translateZ(0px);"
        >
          <svg
            class="absolute bottom-0 overflow-hidden"
            xmlns="http://www.w3.org/2000/svg"
            preserveAspectRatio="none"
            version="1.1"
            viewBox="0 0 2560 100"
            x="0"
            y="0"
          >
            <polygon
              class="text-gray-300 fill-current"
              points="2560 0 2560 100 0 100"
            ></polygon>
          </svg>
        </div>
      </section>
      <section class="relative py-16 bg-gray-300">
        <div class="container mx-auto px-4">
          <div class="justify-between pt-12 -mt-64">
            <div class="mx-0 sm:mx-6">
              <div
                class="bg-white w-full p-8 md:p-24 text-xl md:text-2xl text-gray-800 leading-normal"
                style="font-family:Georgia,serif;"
              >
                <div class="text-center">
                  <p class="text-sm md:text-base text-teal-500 font-bold">
                    08 APRIL 2019 <span class="text-gray-900">/</span> GETTING
                    STARTED
                  </p>
                  <h1 class="font-bold break-normal text-3xl md:text-5xl">
                    Welcome to Ghostwind CSS
                  </h1>
                </div>

                <!--image-->
                <div
                  class="container w-full max-w-6xl mx-auto bg-white bg-cover mt-8 rounded"
                  style="background-image:url('/img/photo/photo.jpg'); height: 75vh;"
                ></div>
                <!--Post Content-->

                <!--Lead Para-->
                <p class="text-2xl md:text-3xl mb-5">
                  👋 Welcome fellow
                  <a
                    class="text-gray-800 hover:text-teal-500 no-underline border-b-2 border-teal-500"
                    href="https://www.tailwindcss.com"
                    >Tailwind CSS</a
                  >
                  and
                  <a
                    class="text-gray-800 hover:text-teal-500 no-underline border-b-2 border-teal-500"
                    href="https://www.ghost.org"
                    >Ghost</a
                  >
                  fan. This starter template is an attempt to replicate the
                  default Ghost theme
                  <a
                    class="text-gray-800 hover:text-teal-500 no-underline border-b-2 border-teal-500"
                    href="https://demo.ghost.io/welcome"
                    >"Casper"</a
                  >
                  using Tailwind CSS and vanilla Javascript.
                </p>

                <p class="py-6">
                  The basic blog page layout is available and all using the
                  default Tailwind CSS classes (although there are a few
                  hardcoded style tags). If you are going to use this in your
                  project, you will want to convert the classes into components.
                </p>

                <p class="py-6">
                  Sed dignissim lectus ut tincidunt vulputate. Fusce tincidunt
                  lacus purus, in mattis tortor sollicitudin pretium. Phasellus
                  at diam posuere, scelerisque nisl sit amet, tincidunt urna.
                  Cras nisi diam, pulvinar ut molestie eget, eleifend ac magna.
                  Sed at lorem condimentum, dignissim lorem eu, blandit massa.
                  Phasellus eleifend turpis vel erat bibendum scelerisque.
                  Maecenas id risus dictum, rhoncus odio vitae, maximus purus.
                  Etiam efficitur dolor in dolor molestie ornare. Aenean
                  pulvinar diam nec neque tincidunt, vitae molestie quam
                  fermentum. Donec ac pretium diam. Suspendisse sed odio risus.
                  Nunc nec luctus nisi. Class aptent taciti sociosqu ad litora
                  torquent per conubia nostra, per inceptos himenaeos. Duis nec
                  nulla eget sem dictum elementum.
                </p>

                <ol>
                  <li class="py-3">
                    Maecenas accumsan lacus sit amet elementum porta. Aliquam eu
                    libero lectus. Fusce vehicula dictum mi. In non dolor at sem
                    ullamcorper venenatis ut sed dui. Ut ut est quam.
                    Suspendisse quam quam, commodo sit amet placerat in,
                    interdum a ipsum. Morbi sit amet tellus scelerisque tortor
                    semper posuere.
                  </li>
                  <li class="py-3">
                    Morbi varius posuere blandit. Praesent gravida bibendum
                    neque eget commodo. Duis auctor ornare mauris, eu accumsan
                    odio viverra in. Proin sagittis maximus pharetra. Nullam
                    lorem mauris, faucibus ut odio tempus, ultrices aliquet ex.
                    Nam id quam eget ipsum luctus hendrerit. Ut eros magna,
                    eleifend ac ornare vulputate, pretium nec felis.
                  </li>
                  <li class="py-3">
                    Vestibulum ante ipsum primis in faucibus orci luctus et
                    ultrices posuere cubilia Curae; Nunc vitae pretium elit.
                    Cras leo mauris, tristique in risus ac, tristique rutrum
                    velit. Mauris accumsan tempor felis vitae gravida. Cras
                    egestas convallis malesuada. Etiam ac ante id tortor
                    vulputate pretium. Maecenas vel sapien suscipit, elementum
                    odio et, consequat tellus.
                  </li>
                </ol>

                <blockquote
                  class="border-l-4 border-teal-500 italic my-8 pl-8 md:pl-12"
                >
                  Example of blockquote - Lorem ipsum dolor sit amet,
                  consectetur adipiscing elit. Aliquam at ipsum eu nunc commodo
                  posuere et sit amet ligula.
                </blockquote>

                <p class="py-6">Example code block:</p>

                <!--/ Post Content-->
              </div>

              <!--Subscribe-->
              <div
                class="container font-sans bg-teal-100 rounded mt-8 p-4 md:p-24 text-center"
              >
                <h2 class="font-bold break-normal text-2xl md:text-4xl">
                  Subscribe to Ghostwind CSS
                </h2>
                <h3
                  class="font-bold break-normal font-normal text-gray-600 text-base md:text-xl"
                >
                  Get the latest posts delivered right to your inbox
                </h3>
                <div class="w-full text-center pt-4">
                  <form action="#">
                    <div
                      class="max-w-sm mx-auto p-1 pr-0 flex flex-wrap items-center"
                    >
                      <input
                        type="email"
                        placeholder="youremail@example.com"
                        class="flex-1 appearance-none rounded shadow p-3 text-gray-600 mr-2 focus:outline-none"
                      />
                      <button
                        type="submit"
                        class="flex-1 mt-4 md:mt-0 block md:inline-block appearance-none bg-teal-500 text-white text-base font-semibold tracking-wider uppercase py-4 rounded shadow hover:bg-teal-400"
                      >
                        Subscribe
                      </button>
                    </div>
                  </form>
                </div>
              </div>
              <!-- /Subscribe-->

              <!--Author-->
              <div class="flex w-full items-center font-sans p-8 md:p-24">
                <img
                  class="w-10 h-10 rounded-full mr-4"
                  src="http://i.pravatar.cc/300"
                  alt="Avatar of Author"
                />
                <div class="flex-1">
                  <p
                    class="text-base font-bold text-base md:text-xl leading-none"
                  >
                    Ghostwind CSS
                  </p>
                  <p class="text-gray-600 text-xs md:text-base">
                    Tailwind CSS version of Ghost's Casper theme by
                    <a
                      class="text-gray-800 hover:text-teal-500 no-underline border-b-2 border-teal-500"
                      href="https://www.tailwindtoolbox.com"
                      >TailwindToolbox.com</a
                    >
                  </p>
                </div>
                <div class="justify-end">
                  <button
                    class="bg-transparent border border-gray-500 hover:border-teal-500 text-xs text-gray-500 hover:text-teal-500 font-bold py-2 px-4 rounded-full"
                  >
                    Read More
                  </button>
                </div>
              </div>
              <!--/Author-->
            </div>
          </div>
        </div>
      </section>
    </main>
  </site-layout>
</template>

<script>
import SiteLayout from "@/Layouts/SiteLayout";

export default {
  components: {
    SiteLayout
  }
};
</script>
