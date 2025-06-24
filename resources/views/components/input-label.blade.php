@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm ']) }}>
    {{ $value ?? $slot }}
</label>
<style>
    label{
        margin-bottom: 5px;
        color: #000;
        font-family: Inter;
        font-size: 20px;
        font-style: normal;
        font-weight: 400;
        line-height: normal;
    }
</style>