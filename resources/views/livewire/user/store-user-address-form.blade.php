
<section id="store-address-form" class="{{$display}}">
    <div class="model">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Address</h5>
                    <button type="button" class="btn-close" wire:click="close" ></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="submitAddress">
                        <div class="container" >
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="first_name">First Name:</label>
                                        <input type="text"  class="form-control" id="first_name" wire:model="first_name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="last_name">Last Name:</label>
                                        <input type="text" class="form-control" id="last_name" wire:model="last_name">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="Address_line1">Address:</label>
                                        <input type="text"  class="form-control" id="Address_line1" wire:model="address">
                                        @error('address') <span class="error">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                              
                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label for="City">City:</label>

                                        <select id="City" wire:model="city" class="form-control" wire:change='changeCity'>
                                            <option>--Select City--</option>
                                            @foreach ($governments as $government)
                                                <option value="{{ $government->id }}">{{ $government->govern_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('city') <span class="error">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="State">State:</label>
                                        <select id="State"  class="form-control" wire:model="state">
                                            <option value="">--Select State--</option>
                                            @foreach ($states as $state)
                                                <option value="{{ $state->id }}">{{ $state->state_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('state') <span class="error">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mobile">Mobile:</label>
                                        <input type="text"  class="form-control" id="mobile" wire:model="mobile">
                                        @error('mobile') <span class="error">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" wire:click="close">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
              
            </div>
        </div>
    </div>


</section>
