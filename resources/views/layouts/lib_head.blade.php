@php
    $content = DB::table('wp_structure')->get()->first();
@endphp
@if(!empty($content->head))
{!! html_entity_decode($content->head) !!}
@endif
