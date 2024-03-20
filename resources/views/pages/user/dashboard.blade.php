<form action="{{route('admin.login')}}" method="POST">
    @csrf

    <div class="my-3">

        <div class="input-group ">
            <span class="input-group-text" id="email">

                Email

            </span>

            <input class="form-control "  type="text"
                name="email" aria-describedby="email" />



        </div>
       
    </div>



    <div class="input-group ">
        <span class="input-group-text" id="pass">

            Password

        </span>
        <input class="form-control "  type="password"
           name="password" aria-describedby="pass" />

    </div>
   





    <button class="btn  w-100 mt-3" type="submit">Sign in</button>


</form>


<div>
   
 @if (session('email'))
 {{session('email')}}
     
 @endif
   
</div>




