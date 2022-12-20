@php
    $content = DB::table('wp_structure')->get()->first();
@endphp
@if(!empty($content->footer))
{!! html_entity_decode($content->footer) !!}
@endif
