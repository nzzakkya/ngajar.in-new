@if(session()->has('status'))
<div class="alert alert-primary" role="alert">
    {{ session()->get('status') }}
</div>
@endif