<button id="button" {{ $attributes->merge(['type' => 'submit', 'class' => 'transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
<style>
    
#button {
  position: relative;
  width: 100%;
  border: 2px solidrgb(53, 0, 107);
  background-color:rgb(0, 0, 0);
  height: 40px;
  color: white;
  font-size: .8em;
  font-weight: 500;
  letter-spacing: 1px;
  cursor: pointer;
  overflow: hidden;
}


</style>
