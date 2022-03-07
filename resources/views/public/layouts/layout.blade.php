<!DOCTYPE html>
<html lang="en">
    
    {{-- Load Common Header which loads header part and all css --}}
    @include('common.layout.header') 

    @if(isset($breadcrumbs))
        @if(!empty($breadcrumbs['type'])) 
            @include('common.layout.register_breadcrumb')
        @else
            @include('common.layout.breadcrumb')
        @endif
    @endif

    
    
    {{-- Load Common slider --}}
    @include('common.pages.slider') 

    {{-- Page content load here --}}
    @yield('content') 
    
    {{-- Load Common Footer --}}
    @include('common.layout.footer') 


    
</html>