<x-dashboard-layout>
 
  
     @if (Route::currentRouteName()=='role.index')
     <h1 class=" text-start text-5xl m-3">Roles</h1>
      
    
     @endif

     @if (Route::currentRouteName()=='Permission.index')
     <h1 class=" text-start text-5xl m-3">Permissions</h1>  
     @endif
     @if (Route::currentRouteName()=='devision.index')
     <h1 class=" text-start text-5xl m-3">Devisions</h1>  
     @endif
     @if (Route::currentRouteName()=='category.index')
     <h1 class=" text-start text-5xl m-3">Categories</h1>  
     @endif

     @isset($roles)
     <roles-table :roles="{{$roles}}"></roles-table>
     @endisset

     @isset($permissions)
     <roles-table :permissions="{{$permissions}}"></roles-table>
     @endisset
     @isset($devisions)
     <roles-table :devisions="{{$devisions}}"></roles-table>
     @endisset
     @isset($categories)
     <roles-table :categories="{{$categories}}"></roles-table>
     @endisset
     
 
</x-dashboard-layout>