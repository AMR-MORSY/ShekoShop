<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use App\Models\State;
use Livewire\Component;
use App\Models\Government;
use App\Models\User_Address;


class StoreUserAddressForm extends Component
{
    public $first_name, $last_name, $mobile;
    public $governments, $states, $address, $state, $city;
    public $display;


    protected $listeners = ['showStoreUserAddressForm'];

    public function showStoreUserAddressForm($user_id)
    {
        $user = User::find($user_id);
        $this->first_name = $user->first_name;
        $this->last_name = $user->last_name;

        $this->display = 'display_block';
    }

    public function mount()
    {
        $this->display = "display_none";
        $this->governments = Government::all();
        $this->states = [];


        $this->city = '';
        $this->state = '';
        $this->address = '';

        $this->first_name = '';
        $this->last_name = '';
        $this->mobile = "";
    }
    public function changeCity()
    {
       
        if ($this->city != "") {
            $Govern = Government::find($this->city);

            $this->states = $Govern->states;
        }
    }

    protected $rules = [
        "mobile" => ['required', 'regex:/^[0][1]([0-2]|5)\d{8}$/', 'unique:users_addresses,mobile'],
        "address" => 'required|string',
        "state" => 'required|exists:states,id',
        "city" => 'required|exists:governments,id'
    ];


    protected $messages = [
        "mobile.required" => "please Enter Phone number",
        "mobile.unique" => "The mobile number already Exist",
        "mobile.regex" => "invalid mobile number",
        "address.required" => "please Enter Valid Address",
        "address.string" => "invalid Address",
        "city.exists" => 'invalid city',
        "state.exists" => 'invalid State'
    ];
    public function close()
    {
        $this->display = "display_none";
    }
    public function authorize()
    {


        if (Auth()->user()) {
            return true;
        } else {
            return false;
        }
    }

    public function submitAddress()
    {
        if ($this->authorize()) {
            $validated = $this->validate();
            User_Address::create([
                'mobile' => $validated['mobile'],
                "government_id" => $validated['city'],
                "state_id" => $validated['state'],
                "address" => $validated['address'],
                "user_id"=>Auth()->user()->id
            ]);

            return redirect()->route('checkout', ["user" => Auth()->user()->id]);
        } else {
            return response("Forbidden", 404);
        }
    }

   
    public function render()
    {
        return view('livewire.user.store-user-address-form');
    }
}
