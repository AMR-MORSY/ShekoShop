<section id="add-color-notification" style="display: {{$display}}">

    <div class="confirmation">
        <i class="fa-solid fa-xmark close"
        style="position:absolute;  width:20%; text-align:right; top:2rem; right:2rem; z-index:200;"
        wire:click.prevent="close"></i>
        <p>Product Stock is Empty:</p>
        <p class="question">Please Add Colors and Sizes?</p>
        <div class="buttons-container">
            <button class="btn btn-info" wire:click.prevent="goToUpdateProduct">YES</button>
            <button class="btn btn-danger" wire:click.prevent="close">NO</button>
        </div>
    </div>

   

</section>
