<x-dashboard-layout>
    <h1 class="text-5xl m-3">Edit Role</h1>
   
  <edit-role :role={{$role}} :permissions="{{$permissions}} " :availablepermissions="{{json_encode($availablepermissions) }}"></edit-role>

</x-dashboard-layout>
