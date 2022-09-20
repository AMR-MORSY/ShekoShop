<div {{ $attributes->merge(['class' => "modal fade"]) }}  tabindex="-1" data-bs-backdrop="static"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{$title}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            
                {{$errors}}
                {{$modalBody}}
               
            </div>
            <div class="modal-footer">
               {{$footer}}
            </div>
        </div>
    </div>
</div>
