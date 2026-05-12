```blade id="jlwmq4"
<div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-6">

    <div>

        <h1 class="text-3xl font-bold text-gray-800">
            {{ $title }}
        </h1>

        @isset($subtitle)

            <p class="text-gray-500 mt-1">
                {{ $subtitle }}
            </p>

        @endisset

    </div>

    <div>

        {{ $actions ?? '' }}

    </div>

</div>
```
