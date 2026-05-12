```blade id="3jlwmb"
<a {{ $attributes->merge([
    'class' =>
    'inline-flex items-center px-5 py-3 rounded-xl
    bg-gradient-to-r from-indigo-500 to-purple-500
    text-white font-semibold shadow-lg
    hover:scale-105 hover:shadow-xl
    transition duration-300'
]) }}>

    {{ $slot }}

</a>
```
