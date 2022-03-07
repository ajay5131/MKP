<!DOCTYPE html>
<html lang="en">
    
    {{-- Load Common Header which loads header part and all css --}}
    @include('common.layout.header')   
    
    {{-- Load Common slider --}}
    @include('common.pages.slider') 

    {{-- Page content load here --}}
    @yield('content') 
    
    {{-- Load Common Footer --}}
    @include('common.layout.footer') 


    
</html>