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
          <div class="flex flex-wrap justify-between pt-12 -mt-64">
            <!--1/3 col -->
            <div
              class="w-full md:w-1/3 p-6 flex flex-col flex-grow flex-shrink"
            >
              <div
                class="flex-1 bg-white rounded-t rounded-b-none overflow-hidden shadow-lg"
              >
                <a
                  href="#"
                  class="flex flex-wrap no-underline hover:no-underline"
                >
                  <img
                    src="/img/photo/photo.jpg"
                    class="h-64 w-full rounded-t pb-6"
                  />
                  <p class="w-full text-gray-600 text-xs md:text-sm px-6">
                    GETTING STARTED
                  </p>
                  <div class="w-full font-bold text-xl text-gray-900 px-6">
                    Lorem ipsum dolor sit amet.
                  </div>
                  <p class="text-gray-800 font-serif text-base px-6 mb-5">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                    Aliquam at ipsum eu nunc commodo posuere et sit amet ligula.
                  </p>
                </a>
              </div>
              <div
                class="flex-none mt-auto bg-white rounded-b rounded-t-none overflow-hidden shadow-lg p-6"
              >
                <div class="flex items-center justify-between">
                  <img
                    class="w-8 h-8 rounded-full mr-4 avatar"
                    data-tippy-content="Author Name"
                    src="http://i.pravatar.cc/300"
                    alt="Avatar of Author"
                  />
                  <p class="text-gray-600 text-xs md:text-sm">1 MIN READ</p>
                </div>
              </div>
            </div>

            <!--1/3 col -->
            <div
              class="w-full md:w-1/3 p-6 flex flex-col flex-grow flex-shrink"
            >
              <div
                class="flex-1 bg-white rounded-t rounded-b-none overflow-hidden shadow-lg"
              >
                <a
                  href="#"
                  class="flex flex-wrap no-underline hover:no-underline"
                >
                  <img
                    src="/img/photo/photo.jpg"
                    class="h-64 w-full rounded-t pb-6"
                  />
                  <p class="w-full text-gray-600 text-xs md:text-sm px-6">
                    GETTING STARTED
                  </p>
                  <div class="w-full font-bold text-xl text-gray-900 px-6">
                    Lorem ipsum dolor sit amet.
                  </div>
                  <p class="text-gray-800 font-serif text-base px-6 mb-5">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                    ipsum dolor sit amet, consectetur adipiscing elit. Aliquam
                    at ip Aliquam at ipsum eu nunc commodo posuere et sit amet
                    ligula.
                  </p>
                </a>
              </div>
              <div
                class="flex-none mt-auto bg-white rounded-b rounded-t-none overflow-hidden shadow-lg p-6"
              >
                <div class="flex items-center justify-between">
                  <img
                    class="w-8 h-8 rounded-full mr-4 avatar"
                    data-tippy-content="Author Name"
                    src="http://i.pravatar.cc/300"
                    alt="Avatar of Author"
                  />
                  <p class="text-gray-600 text-xs md:text-sm">1 MIN READ</p>
                </div>
              </div>
            </div>

            <!--1/3 col -->
            <div
              class="w-full md:w-1/3 p-6 flex flex-col flex-grow flex-shrink"
            >
              <div
                class="flex-1 bg-white rounded-t rounded-b-none overflow-hidden shadow-lg"
              >
                <a
                  href="#"
                  class="flex flex-wrap no-underline hover:no-underline"
                >
                  <img
                    src="/img/photo/photo.jpg"
                    class="h-64 w-full rounded-t pb-6"
                  />
                  <p class="w-full text-gray-600 text-xs md:text-sm px-6">
                    GETTING STARTED
                  </p>
                  <div class="w-full  font-bold text-xl text-gray-900 px-6">
                    Lorem ipsum dolor sit amet.
                  </div>
                  <p class="text-gray-800 font-serif text-base px-6 mb-5">
                    Lorem ipsum eu nunc commodo posuere et sit amet ligula.
                  </p>
                </a>
              </div>
              <div
                class="flex-none mt-auto bg-white rounded-b rounded-t-none overflow-hidden shadow-lg p-6"
              >
                <div class="flex items-center justify-between">
                  <img
                    class="w-8 h-8 rounded-full mr-4 avatar"
                    data-tippy-content="Author Name"
                    src="http://i.pravatar.cc/300"
                    alt="Avatar of Author"
                  />
                  <p class="text-gray-600 text-xs md:text-sm">1 MIN READ</p>
                </div>
              </div>
            </div>

            <!--1/2 col -->
            <div
              class="w-full md:w-1/2 p-6 flex flex-col flex-grow flex-shrink"
            >
              <div
                class="flex-1 bg-white rounded-t rounded-b-none overflow-hidden shadow-lg"
              >
                <a
                  href="#"
                  class="flex flex-wrap no-underline hover:no-underline"
                >
                  <img
                    src="/img/photo/photo.jpg"
                    class="h-full w-full rounded-t pb-6"
                  />
                  <p class="w-full text-gray-600 text-xs md:text-sm px-6">
                    GETTING STARTED
                  </p>
                  <div class="w-full font-bold text-xl text-gray-900 px-6">
                    Lorem ipsum dolor sit amet.
                  </div>
                  <p class="text-gray-800 font-serif text-base px-6 mb-5">
                    Lorem ipsum eu nunc commodo posuere et sit amet ligula.
                  </p>
                </a>
              </div>
              <div
                class="flex-none mt-auto bg-white rounded-b rounded-t-none overflow-hidden shadow-lg p-6"
              >
                <div class="flex items-center justify-between">
                  <img
                    class="w-8 h-8 rounded-full mr-4 avatar"
                    data-tippy-content="Author Name"
                    src="http://i.pravatar.cc/300"
                    alt="Avatar of Author"
                  />
                  <p class="text-gray-600 text-xs md:text-sm">1 MIN READ</p>
                </div>
              </div>
            </div>

            <!--1/2 col -->
            <div
              class="w-full md:w-1/2 p-6 flex flex-col flex-grow flex-shrink"
            >
              <div
                class="flex-1 flex-row bg-white rounded-t rounded-b-none overflow-hidden shadow-lg"
              >
                <a
                  href="#"
                  class="flex flex-wrap no-underline hover:no-underline"
                >
                  <img
                    src="/img/photo/photo.jpg"
                    class="h-full w-full rounded-t pb-6"
                  />
                  <p class="w-full text-gray-600 text-xs md:text-sm px-6">
                    GETTING STARTED
                  </p>
                  <div class="w-full font-bold text-xl text-gray-900 px-6">
                    Lorem ipsum dolor sit amet.
                  </div>
                  <p class="text-gray-800 font-serif text-base px-6 mb-5">
                    Lorem ipsum eu nunc commodo posuere et sit amet ligula.
                  </p>
                </a>
              </div>
              <div
                class="flex-none mt-auto bg-white rounded-b rounded-t-none overflow-hidden shadow-lg p-6"
              >
                <div class="flex items-center justify-between">
                  <img
                    class="w-8 h-8 rounded-full mr-4 avatar"
                    data-tippy-content="Author Name"
                    src="http://i.pravatar.cc/300"
                    alt="Avatar of Author"
                  />
                  <p class="text-gray-600 text-xs md:text-sm">1 MIN READ</p>
                </div>
              </div>
            </div>

            <!--2/3 col -->
            <div
              class="w-full md:w-2/3 p-6 flex flex-col flex-grow flex-shrink"
            >
              <div
                class="flex-1 bg-white rounded-t rounded-b-none overflow-hidden shadow-lg"
              >
                <a
                  href="#"
                  class="flex flex-wrap no-underline hover:no-underline"
                >
                  <img
                    src="/img/photo/photo.jpg"
                    class="h-full w-full rounded-t pb-6"
                  />
                  <p class="w-full text-gray-600 text-xs md:text-sm px-6">
                    GETTING STARTED
                  </p>
                  <div class="w-full font-bold text-xl text-gray-900 px-6">
                    Lorem ipsum dolor sit amet.
                  </div>
                  <p class="text-gray-800 font-serif text-base px-6 mb-5">
                    Lorem ipsum eu nunc commodo posuere et sit amet ligula.
                  </p>
                </a>
              </div>
              <div
                class="flex-none mt-auto bg-white rounded-b rounded-t-none overflow-hidden shadow-lg p-6"
              >
                <div class="flex items-center justify-between">
                  <img
                    class="w-8 h-8 rounded-full mr-4 avatar"
                    data-tippy-content="Author Name"
                    src="http://i.pravatar.cc/300"
                    alt="Avatar of Author"
                  />
                  <p class="text-gray-600 text-xs md:text-sm">1 MIN READ</p>
                </div>
              </div>
            </div>

            <!--1/3 col -->
            <div
              class="w-full md:w-1/3 p-6 flex flex-col flex-grow flex-shrink"
            >
              <div
                class="flex-1 bg-white rounded-t rounded-b-none overflow-hidden shadow-lg"
              >
                <a
                  href="#"
                  class="flex flex-wrap no-underline hover:no-underline"
                >
                  <img
                    src="/img/photo/photo.jpg"
                    class="h-full w-full rounded-t pb-6"
                  />
                  <p class="w-full text-gray-600 text-xs md:text-sm px-6">
                    GETTING STARTED
                  </p>
                  <div class="w-full font-bold text-xl text-gray-900 px-6">
                    Lorem ipsum dolor sit amet.
                  </div>
                  <p class="text-gray-800 font-serif text-base px-6 mb-5">
                    Lorem ipsum eu nunc commodo posuere et sit amet ligula.
                  </p>
                </a>
              </div>
              <div
                class="flex-none mt-auto bg-white rounded-b rounded-t-none overflow-hidden shadow-lg p-6"
              >
                <div class="flex items-center justify-between">
                  <img
                    class="w-8 h-8 rounded-full mr-4 avatar"
                    data-tippy-content="Author Name"
                    src="http://i.pravatar.cc/300"
                    alt="Avatar of Author"
                  />
                  <p class="text-gray-600 text-xs md:text-sm">1 MIN READ</p>
                </div>
              </div>
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
