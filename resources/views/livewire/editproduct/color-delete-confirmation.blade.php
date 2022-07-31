<section id="colorDeleteConfirmation" style="display: {{$display}}">

    <div class="confirmation">
        <i class="fa-solid fa-xmark close"
        style="position:absolute;  width:20%; text-align:right; top:2rem; right:2rem; z-index:200;"
        wire:click.prevent="close"></i>
        <p>No Sizes Available for this color</p>
        <p class="question">Delete the color and all its related Images?</p>
        <div class="buttons-container">
            <button class="btn btn-info" wire:click.prevent="delete_color">YES</button>
            <button class="btn btn-danger" wire:click.prevent="close">NO</button>
        </div>
    </div>

   

</section>
