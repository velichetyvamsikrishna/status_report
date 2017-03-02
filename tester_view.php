<nav style="border:1px solid #eee;" class="navbar navbar">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="index.php">Accessibility Status Report</a>
    </div>
    <div class="collapse navbar-collapse" >
	  <ul class="nav navbar-nav">
        <li><a onclick="submit_test_results();">Submit Test Results</a></li>
		<li><a onclick="modify_update_test_results()">Modify Test Results</a></li>
		<li><a onclick="view_test_results()">View Test Results</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a onClick="log_out()"><span class="glyphicon glyphicon-log-out"></span> Logout  </a></li>
      </ul>
    </div>
  </div>
</nav>