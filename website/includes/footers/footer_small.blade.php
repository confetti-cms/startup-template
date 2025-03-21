@php($footer = extendModel($model))
<footer class="shadow-sm dark:bg-gray-800">
    <div class="w-full mx-auto max-w-(--breakpoint-xl) p-4 md:flex md:items-center md:justify-between">
      <span class="text-sm text-gray-500 sm:text-center">
          © {{ date('Y') }}
          <a href="/" class="hover:underline">
              Your Company
          </a>
    </span>
        <ul class="flex flex-wrap items-center mt-3 text-sm font-medium text-gray-500 sm:mt-0">
            <li>
                <a href="/contact" class="mr-4 hover:underline md:mr-6 ">
                    {{ $footer->text('text_link_1')->default('Contact') }}
                </a>
            </li>
            <li>
                <a href="/privacy-policy" class="mr-4 hover:underline md:mr-6">
                    {{ $footer->text('text_link_2')->default('Privacy Policy') }}
                </a>
            </li>
        </ul>
    </div>
</footer>