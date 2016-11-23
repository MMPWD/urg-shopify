@if (isset($notifications))
    <div class="row">
        <div class="small-12 columns">
            <div class="warning callout" data-closable>
                <h2>Please note</h2>

                <ul>
                    @foreach ($notifications as $notification)
                        <li><?php echo $notification ?></li>
                    @endforeach
                </ul>

                <button class="close-button" aria-label="Dismiss alert" type="button" data-close>
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>
@endif