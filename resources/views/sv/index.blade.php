@extends('base')

@section('title', 'Singing Valentines with React')
{{-- @section('sv_order_tab', 'active') --}}

@section('additional_includes')
  <!-- Datatables CSS -->
  <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.13/css/jquery.dataTables.css">
  <!--<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css">-->
    
  <!-- Datatables JS -->
  <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.13/js/jquery.dataTables.js"></script>
  <!--<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>-->


  <!-- My additional JS -->
  {{-- <script type="text/javascript" src="/js/sv.js"></script> --}}


 @endsection

@section('content')

<div id="root"></div>
{{-- react_bundle.js was manually copied over from react js outputed from npm run build: /public/singing-valentines/build/static/js/main.b40fe449d.js --}}
{{-- Can still use npm start for development when learning React --}}
<script type="text/javascript" src="/js/react_bundle.js"></script>

@endsection
