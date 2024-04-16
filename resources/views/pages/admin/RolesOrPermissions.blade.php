<x-dashboard-layout>
 
  
     @if (Route::currentRouteName()=='role.index')
     <h1 class=" text-start text-5xl m-3">Roles</h1>
     <roles-table :roles="{{$roles}}"></roles-table>
    
     @endif

     @if (Route::currentRouteName()=='Permission.index')
     <h1 class=" text-start text-5xl m-3">Permissions</h1>  
     <roles-table :permissions="{{$permissions}}"></roles-table>
     @endif
     @if (Route::currentRouteName()=='devision.index')
     <h1 class=" text-start text-5xl m-3">Devisions</h1>  
     <roles-table :devisions="{{$devisions}}"></roles-table>
     @endif
     @if (Route::currentRouteName()=='category.index')
     <h1 class=" text-start text-5xl m-3">Categories</h1>  
     <roles-table :categories="{{$categories}}"></roles-table>
     @endif

     
 
</x-dashboard-layout>