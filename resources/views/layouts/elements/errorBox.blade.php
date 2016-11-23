@if (count($errors) > 0)
    <div class="row">
        <div class="small-12 columns">
            <div class="alert callout" data-closable>
                <h2>Please check for errors</h2>

                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>

                <p style="margin-bottom: 0;">Please look through the form and correct the errors to
                    continue.</p>
                <button class="close-button" aria-label="Dismiss alert" type="button" data-close>
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>
@endif

