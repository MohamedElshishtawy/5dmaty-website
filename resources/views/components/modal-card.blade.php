@props(['title' => __('general.manage'), 'footer' => '', 'body' => ''])

<div class="modal-card">
    <header class="modal-card-head">
        <h3 class="modal-card-title">{{ $title }}</h3>
    </header>
    <section class="modal-card-body">
        {{ $body }}
    </section>
    <footer class="modal-card-foot">
        {{ $footer ?? ''  }}
    </footer>
</div>
