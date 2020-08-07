<div class="sidebar" data-color="orange">
  <!--
    Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
-->
  <div class="logo">
    <a href="{{ url('/') }}" class="simple-text logo-mini">
      {{ config('app.name', 'Laravel') }}
    </a>
    <a href="http://www.index" class="simple-text logo-normal">
      admin
    </a>
  </div>
  <div class="sidebar-wrapper" id="sidebar-wrapper">
    <ul class="nav">
      <li class="active ">
        <a href="./index.html">
          <i class="now-ui-icons design_app"></i>
          <p>Home</p>
        </a>
      </li>
      <li>
        <a href="./accounts.html">
          <i class="now-ui-icons education_atom"></i>
          <p>User Accounts</p>
        </a>
      </li>
      <li>
        <a href="./prices.html">
          <i class="now-ui-icons education_atom"></i>
          <p>Charges and Prices</p>
        </a>
      </li>
      <li>
        <a href="./reports.html">
          <i class="now-ui-icons education_atom"></i>
          <p>Reports</p>
        </a>
      </li>
      <li>
        <a href="./complaints.html">
          <i class="now-ui-icons education_atom"></i>
          <p>Complaints</p>
        </a>
      </li>
        <li>
          <a href="./logs.html">
            <i class="now-ui-icons education_atom"></i>
            <p>Logs</p>
          </a>
        </li>
    </ul>
  </div>
</div>
