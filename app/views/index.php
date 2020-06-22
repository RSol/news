<section class="text-gray-700 body-font bg-gray-200">
    <div class="container px-5 py-24 mx-auto">
        <div id="target">Loading...</div>
    </div>
</section>

<script id="oneNewsTemplate" type="x-tmpl-mustache">
    <div class="lg:w-4/5 mx-auto flex flex-wrap">
      <img alt="ecommerce" class="lg:w-1/2 w-full lg:h-auto h-64 object-cover object-center rounded" src="{{image}}">
      <div class="lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0">
        <h2 class="text-sm title-font text-gray-500 tracking-widest">{{category}}</h2>
        <h1 class="text-gray-900 text-3xl title-font font-medium mb-1">{{title}}</h1>
        <div class="flex mb-4">
          <span class="flex items-center">
            <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 text-indigo-500" viewBox="0 0 24 24">
              <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
            </svg>
            <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 text-indigo-500" viewBox="0 0 24 24">
              <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
            </svg>
            <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 text-indigo-500" viewBox="0 0 24 24">
              <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
            </svg>
            <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 text-indigo-500" viewBox="0 0 24 24">
              <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
            </svg>
            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 text-indigo-500" viewBox="0 0 24 24">
              <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
            </svg>
            <span class="text-gray-600 ml-3">4 Reviews</span>
          </span>
          <span class="flex ml-3 pl-3 py-2 border-l-2 border-gray-200">
            <a class="text-gray-500">
              <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path>
              </svg>
            </a>
            <a class="ml-2 text-gray-500">
              <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                <path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"></path>
              </svg>
            </a>
            <a class="ml-2 text-gray-500">
              <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                <path d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z"></path>
              </svg>
            </a>
          </span>
        </div>
        <p class="leading-relaxed">{{description}}</p>

        <a class="text-indigo-500 inline-flex items-center md:mb-2 lg:mb-0 backLink" href="/">
            Back
        </a>

      </div>
    </div>

</script>

<script id="sortTemplate" type="x-tmpl-mustache">
<div class="flex flex-wrap -m-4 mb-6">

    <div class="ml-auto flex p-6 bg-white rounded-lg shadow-xl">
        <h4 class="tracking-widest text-xs title-font font-medium text-gray-500 mb-1">Sort by:</h4>

        <div class="p-4 md:w-1/3">
            <a class="text-xs text-indigo-500 sortLink" href="#" rel="">Default</a>
        </div>
        <div class="p-4 md:w-1/3">
            <a class="text-xs text-indigo-500 sortLink" href="#" rel="category_id">Category</a>
        </div>
        <div class="p-4 md:w-1/3">
            <a class="text-xs text-indigo-500 sortLink" href="#" rel="created_at">Date</a>
        </div>

    </div>

</div>

</script>

<script id="pagerTemplate" type="x-tmpl-mustache">
<div class="flex flex-wrap -m-4 my-6">
    <div class="flex p-1 bg-white rounded-lg shadow-xl w-full">
        <div class="p-4 md:w-1/3">
            {{#prevUrl}}
                <a class="text-xs text-indigo-500 pageLink" href="#" rel="-">Prev</a>
            {{/prevUrl}}
        </div>
        <div class="p-4 md:w-1/3 text-center">
            <span class="tracking-widest text-xs title-font font-medium text-gray-500">
                {{currentPage}}/{{totalPages}}
            </span>
        </div>
        <div class="p-4 md:w-1/3 text-right">
            {{#nextUrl}}
                <a class="text-xs text-indigo-500 pageLink" href="#" rel="+">Next</a>
            {{/nextUrl}}
        </div>

    </div>
</div>

</script>

<script id="newsListTemplate" type="x-tmpl-mustache">

<div class="flex flex-wrap -m-4">
    {{#newsList}}
        <div class="p-4 md:w-1/3 bg-white">
            <div class="h-full border-2 border-gray-200 rounded-lg overflow-hidden">
                <img class="lg:h-48 md:h-36 w-full object-cover object-center" src="{{image}}"
                     alt="blog">
                <div class="p-6">
                    <h2 class="tracking-widest text-xs title-font font-medium text-gray-500 mb-1">{{category}}</h2>
                    <h1 class="title-font text-lg font-medium text-gray-900 mb-3">
                        {{title}}
                    </h1>
                    <p class="leading-relaxed mb-3">{{description}}</p>
                    <div class="flex items-center flex-wrap ">
                        <a class="text-indigo-500 inline-flex items-center md:mb-2 lg:mb-0 showOne" href="/news/{{id}}" rel="{{id}}">Learn More
                            <svg class="w-4 h-4 ml-2" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"
                                 fill="none"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 12h14"></path>
                                <path d="M12 5l7 7-7 7"></path>
                            </svg>
                        </a>
                        <span
                                class="text-gray-600 mr-3 inline-flex items-center lg:ml-auto md:ml-0 ml-auto leading-none text-sm pr-3 py-1 border-r-2 border-gray-300">
            <svg class="w-4 h-4 mr-1" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round"
                 stroke-linejoin="round" viewBox="0 0 24 24">
              <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
              <circle cx="12" cy="12" r="3"></circle>
            </svg>1.2K
          </span>
                        <span class="text-gray-600 inline-flex items-center leading-none text-sm">
            <svg class="w-4 h-4 mr-1" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round"
                 stroke-linejoin="round" viewBox="0 0 24 24">
              <path
                      d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z"></path>
            </svg>6
          </span>
                    </div>
                </div>
            </div>
        </div>
    {{/newsList}}
</div>



</script>
