<section id="add-stock" style="display: {{ $display }}">

    <div class="confirmation">
        <i class="fa-solid fa-xmark close"
            style="position:absolute;  width:20%; text-align:right; top:2rem; right:2rem; z-index:200;"
            wire:click.prevent="close"></i>

        <form wire:submit.prevent='addStock'>

            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="product_stock">Stock:</label>
                        <input id="product_stock" type="text" wire:model='product_stock'>

                    </div>

                </div>

                <div class="col-12">
                    <div class="buttons-container">
                        <button class="btn btn-info" type="submit">Submit</button>
                        <button class="btn btn-danger" wire:click.prevent="close">NO</button>
                    </div>

                </div>
            </div>



        </form>

    </div>



</section>
