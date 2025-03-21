@php($feature = newRoot(new \model\homepage\feature)->label('Feature'))
<!-- Go to https://tailwindui.com/components/marketing/sections/feature-sections to get more templates designed by the Tailwind CSS team -->
<div class="overflow-hidden py-24 sm:py-32">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="mx-auto grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 sm:gap-y-20 lg:mx-0 lg:max-w-none lg:grid-cols-2">
            <div class="lg:pt-4 lg:pr-8">
                <div class="lg:max-w-lg">
                    <h2 class="text-base/7 font-semibold text-indigo-600">Deploy faster</h2>
                    <p class="mt-2 text-4xl font-semibold tracking-tight text-pretty text-gray-900 sm:text-5xl">A better workflow</p>
                    <p class="mt-6 text-lg/8 text-gray-600">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Maiores impedit perferendis suscipit eaque, iste dolor cupiditate blanditiis ratione.</p>
                    <dl class="mt-10 max-w-xl space-y-8 text-base/7 text-gray-600 lg:max-w-none">
                        @foreach($feature->list('feature')->min(3)->max(5)->get() as $item)
                        <div class="relative">
                            <dt class="inline font-semibold text-gray-900">
                                {{ $item->text('title')->max(50) }}
                            </dt>
                            <dd class="mt-2 ml-4 text-gray-600">
                                {{ $item->text('description')->max(200) }}
                            </dd>
                        </div>
                        @endforeach
                    </dl>
                </div>
            </div>
            {!! $feature->image('image')->widthPx(960)->getPicture(class: 'w-[48rem] max-w-none rounded-xl ring-1 shadow-xl ring-gray-400/10 sm:w-[57rem] md:-ml-4 lg:-ml-0', alt: 'Product screenshot') !!}
        </div>
    </div>
</div>
