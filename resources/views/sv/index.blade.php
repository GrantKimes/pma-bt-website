@extends('base')

@if ($current_page == 'order')
	@section('sv_order_tab', 'active')
	@section('title', 'Order Singing Valentines')
@elseif ($current_page == 'view')
	@section('sv_view_tab', 'active')
	@section('title', 'View Singing Valentines')
@elseif ($current_page == 'edit')
	@section('sv_edit_tab', 'active')
	@section('title', 'Edit Singing Valentines')
@endif

@section('additional_includes')

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs-3.3.7/dt-1.10.16/r-2.2.1/datatables.min.css"/>


  <!-- Datatables CSS -->
  <!--<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.13/css/jquery.dataTables.css">-->
  <!--<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css">-->
  <!--<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.dataTables.min.css">-->
    
  <!-- Datatables JS -->
  <!--<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.13/js/jquery.dataTables.js"></script>-->
  <!--<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>-->
  <!--<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js"></script>-->


  <!-- My additional JS -->
  {{-- <script type="text/javascript" src="/js/sv.js"></script> --}}


 @endsection

@section('content')

<div id="root"></div>

<script>
window.CURRENT_PAGE = '{{ $current_page }}';
</script>

{{-- react_bundle.js was manually copied over from react js outputed from npm run build: /public/singing-valentines/build/static/js/main.js --}}
{{-- Can still use npm start for development when learning React --}}
<script type="text/javascript" src="/js/main.js"></script>

@endsection
