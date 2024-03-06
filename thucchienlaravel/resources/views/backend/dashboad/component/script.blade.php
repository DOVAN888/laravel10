<script src="backend/js/jquery-3.1.1.min.js"></script>
    <script src="backend/js/bootstrap.min.js"></script>
    <script src="backend/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="backend/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script type="text/javascript" src="backend/library/library.js"></script>
    <script src="backend/js/inspinia.js" type="text/javascript"></script>
      <script src="backend/plugins/pace/pace.min.js" type="text/javascript"></script>
      <script src="backend/plugin/jquery-ui.min.js" type="text/javascript"></script>

    <!-- Flot -->


  @if(isset($config['js']) && is_array($config['js']))
    @foreach($config['js'] as $key => $val)
        <script src="{{ $val }}"></script>
    @endforeach
@endif

<!-- jQuery UI -->

    <!-- jQuery UI -->