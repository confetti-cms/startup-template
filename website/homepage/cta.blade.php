@php($cta = newRoot(new \model\homepage\cta)->label('CTA'))
<!-- Go to https://tailwindui.com/components/marketing/sections/cta-sections to get more templates for your product or service -->
<div class="mx-auto max-w-7xl py-24 sm:px-6 sm:py-32 lg:px-8">
    <div class="relative isolate overflow-hidden bg-gray-900 px-6 pt-16 shadow-2xl sm:rounded-3xl sm:px-16 md:pt-24 lg:flex lg:gap-x-20 lg:px-24 lg:pt-0">
        <svg viewBox="0 0 1024 1024" class="absolute top-1/2 left-1/2 -z-10 size-[64rem] -translate-y-1/2 [mask-image:radial-gradient(closest-side,white,transparent)] sm:left-full sm:-ml-80 lg:left-1/2 lg:ml-0 lg:-translate-x-1/2 lg:translate-y-0" aria-hidden="true">
            <circle cx="512" cy="512" r="512" fill="url(#759c1415-0410-454c-8f7c-9a820de03641)" fill-opacity="0.7" />
            <defs>
                <radialGradient id="759c1415-0410-454c-8f7c-9a820de03641">
                    <stop stop-color="#7775D6" />
                    <stop offset="1" stop-color="#E935C1" />
                </radialGradient>
            </defs>
        </svg>
        <div class="mx-auto max-w-md text-center lg:mx-0 lg:flex-auto lg:py-32 lg:text-left">
            <h2 class="text-3xl font-semibold tracking-tight text-balance text-white sm:text-4xl">{{ $cta->text('title')->default('Ready to dive in?') }}</h2>
            <p class="mt-6 text-lg/8 text-pretty text-gray-300">{{ $cta->text('subtitle')->max(200) }}</p>
            <div class="mt-10 flex items-center justify-center gap-x-6 lg:justify-start">
                <a href="#" class="rounded-md bg-white px-3.5 py-2.5 text-sm font-semibold text-gray-900 shadow-xs hover:bg-gray-100 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white">{{ $cta->text('cta_text')->default('Get started') }}</a>
                <a href="#" class="text-sm/6 font-semibold text-white">{{ $cta->text('link_text')->default('Learn more') }} <span aria-hidden="true">→</span></a>
            </div>
        </div>
        <div class="relative mt-16 h-80 lg:mt-8">
            {!! $cta->image('image')->widthPx(960)->ratio(3, 2)->getPicture(class: 'absolute top-0 left-0 w-[40rem] max-w-none rounded-md bg-white/5 ring-1 ring-white/10') !!}
        </div>
    </div>
</div>
